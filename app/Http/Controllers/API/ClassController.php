<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\Chapter\ChapterResource;
use App\Http\Resources\Level\GradeResource;
use App\Http\Resources\Level\PreparationResource;
use App\Http\Resources\Subject\SubjectResource;
use App\Model\Category;
use App\Model\Content;
use App\Model\PractiseLog;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Question;
use App\Model\QuizLog;
use Illuminate\Support\Facades\Auth;
use JWTAuth;

class ClassController extends Controller
{

    public function getClasses(Request $request){

        $grade = Category::where('slug', 'class')->first();
        $grades = Content::where('type', $grade->id)->get();

        $preparation = Category::where('slug', 'preparation')->first();
        $preparations = Content::where('type', $preparation->id)->get();


        return response()->json([
           'status' => 'success',
            'grades' => GradeResource::collection($grades),
            'preparations' => PreparationResource::collection($preparations),
        ]);

    }


    public function storeClass(Request $request){

        $token = (string)JWTAuth::getToken();
        $user = User::where('id', $request->user_id)->first();

        if($request->auth_token == $token ){

            $updateResponse = $user->userInfo()->updateOrCreate(['user_id' => $user->id] , [
                'content_id' => $request->class_id,
                'user_ip' => $request->ip(),
            ]);
            $className = null;
            if($user->userInfo){
                $content = Content::find($user->userInfo->content_id);
                $className = $content->name;
            }
            if($updateResponse) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'User Successfully Updated',
                    'name' => $user->name,
                    'user_id' => $user->id,
                    'auth_token' => $token,
                    'class_id' => $user->userInfo->content_id,
                    'class_name' => $className,
                ]);
            }else{
                return response()->json([
                    'status' => 'error',
                    'message' => 'Error While Updating!!!',
                ]);
            }

        }else{

            return response()->json([
                'status' => 'error',
                'message' => 'Invalid Auth Token',
            ]);
        }

    }

    public function getSubjects($class_id){

        $contents = Content::where('parent_id', $class_id)->get();
        $user = JWTAuth::user();
        $practice_report = $this->get_practice_report($user,$contents->where('is_practice',1));
        $practice_graph_subjects = $contents->where('is_practice',1)->pluck('name')->toArray();
        $practice_graph_subjects = $contents->where('is_practice',1)->pluck('name')->toArray();
        $test_report_data = $this->get_test_report($user,$contents->where('is_test',1));


        if($contents){
            return response()->json([
                'status' => 'success',
                'learn_subjects' =>SubjectResource::collection($contents->where('is_learn',1)),
                'test_subjects' =>SubjectResource::collection($contents->where('is_test',1)),
                'practice_subjects' =>SubjectResource::collection($contents->where('is_practice',1)),
                'practice_report' => $practice_report,
                'practice_graph_subjects' => $practice_graph_subjects,
                'practise_percentage' => $this->getPractisePercentage($class_id),
                'test_report' => $test_report_data["report"],
                'test_accuracy' => $test_report_data["test_accuracy"],
            ]);
        }else{
            return response()->json([
                'status' => 'error',
                'subjects' =>null
            ]);
        }
    }

    public function get_practice_report($user, $practise_subjects){
        $report = [];
        for($day_count = 6; $day_count>-1; $day_count--){
            $daily_report = new Collection();
            $date = Carbon::today()->subDay($day_count);
            $practice_logs = PractiseLog::where('user_id',$user->id)
                ->whereDate('created_at',$date)
                ->get();
            if($practice_logs->count() > 0){
                $daily_report['date'] = $date->shortEnglishMonth." ".$date->day;
                foreach ($practise_subjects as $sub)
                    $daily_report[$sub->name]=0;

                foreach ($practice_logs as $log) {
                    $chapter_id = $log->chapter_id;
                    $subject=Content::where('id',$chapter_id)->first()->parent;
                    $practise_subjects_ids = $practise_subjects->pluck('id')->toArray();
                    if(in_array($subject->id,$practise_subjects_ids)) {
                        $ques_ans = unserialize($log->question_answer);
                        foreach ($ques_ans as $qa)
                            if ($qa['correct'] == 1) $daily_report[$subject->name] += 1;
                    }
                }
            }
            else{
                $count = 0;
                foreach ($practise_subjects as $sub) {
                    $daily_report[$sub->name] = 0;
                    $count++;
                }
                if($count > 0)
                    $daily_report['date'] = $date->shortEnglishMonth." ".$date->day;
            }
            array_push($report,$daily_report);
        }
        return $report;
    }


    public function getChpters($subject_slug){

        $subject = Content::where('slug', $subject_slug)->first();
        $contents = Content::where('parent_id', $subject->id)->get();
        if($contents){
            return response()->json([
                'status' => 'success',
                'subject_name' => $subject->name,
                'chapter_count' => $contents->count(),
                'chapters' =>ChapterResource::collection($contents)
            ]);
        }else{
            return response()->json([
                'status' => 'error',
                'chapters' =>null
            ]);
        }
    }


//    claculate practise percentage

    public function getPractisePercentage($class_id){
        $subjects = Content::where('parent_id', $class_id)->where('is_practice',1)->get();
        $subjectsPercentage = 0;
        $subjectCount = 0;
        foreach ($subjects as $subject){

            $subjectsPercentage += getsubjectPercentage($subject->id);

            $subjectCount ++;
        }

        if($subjectCount != 0) {
            $practiseSubjectPercentage = $subjectsPercentage / $subjectCount;
        }
        else{
            $practiseSubjectPercentage = 0;
        }
        return $practiseSubjectPercentage;

    }


    public function get_test_report($user, $test_subjects){
        $report = [];
        $attempt_overall = 0;
        $correct_overall = 0;
        $date = Carbon::today()->subDay(30);
        foreach ($test_subjects as $sub){
            $subject = new Collection();
            $test_logs = QuizLog::where('user_id',$user->id)
                ->where('subject_id',$sub->id)
                ->whereDate('created_at','>',$date)
                ->get();
            $correct_sum = 0;
            $attempt_sum = 0;
            if($test_logs->count() > 0){
                foreach ($test_logs as $log) {
                    if($log->question_answer){
                        $log->q_a = unserialize($log->question_answer);
                        $marks = $this->get_test_marks($log);
                        $attempt_sum += $marks['total_marks'];
                        $correct_sum += $marks['obtain_marks'];
                    }
                }
            }
            $attempt_overall += $attempt_sum;
            $correct_overall += $correct_sum;
            $subject["name"] = $sub->name;
            $subject["Attempted"] = $attempt_sum;
            $subject["Correct"] = $correct_sum;
            array_push($report,$subject);
        }
        $test_accuracy = $attempt_overall != 0 ? $correct_overall/$attempt_overall : 0;
        return ["report" =>$report, "test_accuracy" => $test_accuracy];
    }

    public function get_test_marks($testLog){
        $obtain_marks = [];
        $total_marks = [];
        $items = $testLog->q_a;
        foreach ($items as $item){
            $getquestion =  Question::where('id', $item['questionId'])->first();
            $total_marks[] = $getquestion->marks;
            $answer =  $getquestion->answers->where('correct', 1)->where('id', $item['answerId'])->first();
            if($answer) {
                $obtain_marks[] = $answer->question->marks;
            }
        }
        $obtain_marks = array_sum($obtain_marks);
        $total_marks = array_sum($total_marks);
        $marks = ['obtain_marks' => $obtain_marks, 'total_marks' => $total_marks];
        return $marks;
    }


}
