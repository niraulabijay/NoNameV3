<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\Answer\Answer;
use App\Http\Resources\AnswerWithoutCorrect\QuestionResource;
use App\Model\Content;
use App\Model\Question;
use App\Model\QuizLog;
use Carbon\Carbon;
use function GuzzleHttp\Psr7\str;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use JWTAuth;

class QuizLogController extends Controller
{
    public function test_by_subject($subject_slug, $user_id_from_api){
        $user_id = JWTAuth::user()->id;
        $subject = Content::where('slug',$subject_slug)->first();
        //check any ongoing tests
        $value = $this->check_ongoing_tests($subject,$user_id);

        if(is_array($value)){
            return $value;
        }

        else {
//            $questions = $this->algorithm_logic($subject, $user_id);
            $questions = Question::all();
//        dd($questions);
            $question_ids = serialize($questions->pluck('id')->toArray());
//        dd($question_ids);
            $quiz_log = new QuizLog();
            $quiz_log->user_id = $user_id;
            $quiz_log->question_ids = $question_ids;
            $quiz_log->subject_id = $subject->id;
            $quiz_log->start_time = Carbon::now('Asia/Kathmandu')->format('Y-m-d H:i:s');
            $quiz_log->end_time = Carbon::now('Asia/Kathmandu')->addSeconds($subject->time)->format('Y-m-d H:i:s');
            $quiz_log->save();
            $secondsDifference = strtotime($quiz_log->end_time) - strtotime($quiz_log->start_time);

            return [
                'log_id'=>$quiz_log->id,
                'subject_id' => $subject->id,
                'questions' => QuestionResource::collection($questions),
                'time' => $secondsDifference
            ];
        }
    }

    private function check_ongoing_tests($subject, $user_id){
        $current_time = Carbon::now('Asia/Kathmandu')->format('Y-m-d H:i:s');
        //quit any logs of different subject
        $other_subject_log = QuizLog::where('user_id',$user_id)->where('subject_id','!=',$subject->id)->where('quit',0)->where('end_time','>=',$current_time)->where('completed',0)->first();
        if($other_subject_log) {
//            dd($other_subject_log);
            $other_subject_log->quit = 1;
            $other_subject_log->save();
            $return_value = false;
        }
        else{
                $last_subject_log = QuizLog::where('user_id', $user_id)->where('subject_id', $subject->id)->where('quit', 0)->where('end_time', '>=', $current_time)->where('completed', 0)->first();
                if ($last_subject_log) {
                    $log_question_ids = unserialize($last_subject_log->question_ids);
                    $questions = Question::whereIn('id', $log_question_ids)->get();
                    $secondsDifference = strtotime($last_subject_log->end_time) - strtotime($current_time);
                    $return_value = [
                        'log_id' => $last_subject_log->id,
                        'subject_id' => $subject->id,
                        'questions' => QuestionResource::collection($questions),
                        'time' => $secondsDifference
                    ];
                } else {
                    $return_value = false;
                }
        }
        return $return_value;
    }

    public function save_test_log(Request $request){
//        return $request;
//        user_id, subject_id,
        $user_id = JWTAuth::user()->id;
        $log = QuizLog::where('id',$request->log_id)->where('user_id',$user_id)->where('completed',0)->first();
        if($log) {
            $log->question_answer = serialize($request->practise);
            $log->completed = 1;
            $response = $log->save();
            $questions = $this->get_quiz_result($request->practise);
            $marks = $this->get_marks($request->practise);
            if ($response) {
                return response()->json([
//                    'result' =>
                    'status' => 'success',
                    'message' => 'Practise Log Successfully Added',
                    'result' => $questions,
                    'obtain_marks' => $marks,
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Error While Adding!!',
                ]);
            }
        }
        else{
            return response()->json([
                'status' => 'error',
                'message' => 'Error Log Not Found!!',
            ]);
        }
    }

    public function get_marks($practise){

        $obtain_marks = [];
        $total_marks = [];
        foreach ($practise as $item){
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

    private function get_quiz_result($practise){
//        foreach()
        $questions = new Collection();
        foreach ($practise as $item){
            $getquestion =  Question::where('id', $item['questionId'])->first();
            $getquestion->selected = $item['answerId'];
            $getquestion->questionAnswers = Answer::collection($getquestion->answers);
            $questions = $questions->push($getquestion);
        }
        return $questions->map->only(['id','name', 'selected', 'questionAnswers']);

    }

    public function user_quit(Request $request){
        if($log = QuizLog::find($request->log_id)){
            $log->quit = 1;
            $log->save();
            return response()->json([
                'status' => 'success',
                'message' => 'Quiz Log Quit By User!!',
            ]);
        }
        else{
            return response()->json([
                'status' => 'error',
                'message' => 'Error Log Not Found!!',
            ]);
        }
    }

    private function algorithm_logic($subject, $user_id){
        $chapters = $subject->children;
        $questions_for_quiz = new Collection();
        foreach($chapters as $chapter){
            //find question_id of this chapter's question attempted by user
            $filter_layer_1 = $chapter->questions;
            $chapterwise_question = new Collection();
            foreach($chapter->marks_weightages as $mw){
                $filter_layer_2 = $filter_layer_1->where('marks', $mw->marks);
                // return $filter_layer_2;
                $chapter_attempted_question_id = $this->get_user_attempted_questions($user_id, $chapter->id, $mw->marks);
                $iteration_attempt = 0;
                $reps = 0;
                while(1){
                    $questions = $filter_layer_2->random($mw->quantity); // The amount of items you wish to receive
                    // $ques = get_question($mw, $mw->chapter);
                    //check repetition % with user Log!
                    $generated_ids = $questions->pluck('id')->toArray();
                    // return $generated_ids;
                    $generated_ids_count = $questions->count();
                    $repitions = count(array_intersect($generated_ids,$chapter_attempted_question_id));
                    // return $repitions;
                    try{
                        if($generated_ids_count == 0){
                            throw new \Exception("Divisible by zero");
                        }
                        $reps = ($repitions/$generated_ids_count)*100;

                    }catch(\Exception $e){
                        $reps = 0;
                    };
                    // dd($reps);
                    $iteration_attempt++;
                    // dd($iteration_attempt);
                    if($reps<30 || $iteration_attempt >=3){
                        break;
                    }
                }
                $chapterwise_question = $chapterwise_question->merge($questions);
            }
            // dd($chapterwise_question);
            $questions_for_quiz = $questions_for_quiz->merge($chapterwise_question);
        }
        $final_questions =  QuestionResource::collection($questions_for_quiz);
        return $final_questions;
    }

    private function get_user_attempted_questions($user_id, $chapter, $mark){
        $subject = $chapter->parent;
        $quiz_logs = QuizLog::where('user_id',$user_id)->where('subject_id',$subject->id)->get();
        $questions = $chapter->questions->where('marks',$mark);
        $quiz_log_ques_ids = [];
        foreach($quiz_logs as $log){
            $q_ids = unserialize($log->question_ids);
            $quiz_log_ques_ids = array_merge($quiz_log_ques_ids, $q_ids);
        }
        $quiz_log_ques_ids = array_unique($quiz_log_ques_ids);
        $mark_question_ids = Question::where('chapter_id',$chapter->id)
            ->where('marks',$mark)
            ->pluck('id')
            ->toArray();

        $attempted_ids = array_intersect($mark_question_ids, $quiz_log_ques_ids);
        return $attempted_ids;
    }
}
