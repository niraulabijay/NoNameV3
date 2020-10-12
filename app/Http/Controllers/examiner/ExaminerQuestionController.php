<?php

namespace App\Http\Controllers\examiner;

use App\Exceptions\CustomException;
use App\Model\Content;
use App\Model\ExaminerQuiz;
use App\Model\Question;
use App\Model\SystemUser;
use App\User;
use Cartalyst\Sentinel\Native\Facades\Sentinel;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExaminerQuestionController extends Controller
{
    public function questionAssign($quiz_id){
        $quiz = ExaminerQuiz::findOrFail($quiz_id);
        $quiz->subject_title = Content::findOrFail($quiz->subject_id)->name;
        $quiz->class_title = Content::findOrFail($quiz->subject_id)->parent->name;
        $contents = Content::where( 'parent_id', $quiz->subject_id )->get();
        return view('examiner.quizQuestion.questionAssign',compact('quiz','contents'));
    }

    public function getJson($quiz_id){
        $examiner = Sentinel::getUser()->examiner;
        $quiz = ExaminerQuiz::findOrFail($quiz_id);
        if(in_array($quiz->id,$examiner->quizzes->pluck('id')->toArray())) {
            $questions = $quiz->questions;
            $count = 1;

            foreach ($questions as $question) {
                $question->question = substr(strip_tags($question->name),0,20);
                $question->count = $count;
                $question->date = $question->created_at->format('Y-M-d');
                $count++;
            }
            return datatables($questions)->toJson();
        }
        else{
            abort(403,"Unauthorized access");
        }
    }

    public function storeQuestion(Request $request, $quiz_id){
        try{
            $quiz = ExaminerQuiz::findOrFail($quiz_id);
            if($quiz->questions->count() < $quiz->total_questions) {
                $question = Question::create([
                    'name' => $request->question,
                    'chapter_id' => $request->chapter_id,
                    'marks' => $request->marks,
                    'year' => serialize($request->year),
                    'importance' => $request->importance,
                    'publish' => 0,
                ]);
                if ($request->hasFile('image')) {
                    $image = $request->file('image');
                    $filename = time() . '-question' . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path() . '/admin/images/questions/', $filename);
                    $db_filename = '/admin/images/questions/' . $filename;
                    $question->image = $db_filename;
                    $question->save();
                }
                $answers = $request->answer;
                foreach ($answers as $key => $answer) {
                    $correct = $request->correct == $key ? 1 : 0;
                    $question->answers()->create([
                        'name' => $answer,
                        'correct' => $correct,
                    ]);
                }
                $quiz->questions()->attach($question->id);
                return response()->json('Question Add Successfully', 200);
            }else{
                return response()->json('Maximum Allocated Questions Added For This Quiz',500);
            }
        }catch(\Exception $e){
            return response()->json($e->getMessage(),500);
        }
    }
}
