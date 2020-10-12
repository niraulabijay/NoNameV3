<?php

namespace App\Http\Controllers\examiner;

use App\Model\Content;
use App\Model\ExaminerQuiz;
use App\User;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    public function index(){
        $contents = Content::where('parent_id',0)->get();
        return view('examiner.quiz.index',compact('contents'));
    }

    public function getJson(){
        $examiner = Sentinel::getUser()->examiner;
        $quizs = $examiner->quizzes;

        $count = 1;

        foreach ($quizs as $quiz){
            $quiz->count = $count;
            $quiz->date = $quiz->created_at->format('Y-M-d');
            $count++;
        }
        return datatables($quizs)->toJson();
    }

    public function changeQuizContent(Request $request){
        $id = $request->id;
        $type = $request->type;

        $contents = Content::where('parent_id', $id)->get();
        if($type == 'class'){
            return view('examiner.quiz.select-subject', compact('contents'));
        }
        if($type == 'subject'){
            return view('examiner.quiz.select-chapter', compact('contents'));
        }

        return null;
    }

    public function store(Request $request)
    {
//        dd($request);

        $quiz = new ExaminerQuiz();
        $quiz->title = $request->title;
        $quiz->subject_id = $request->subject_id;

        $quiz->examiner_id = User::find(16)->examiner->id;

        $quiz->time = ((int)$request->hour)*3600 + ((int)$request->minute)*60;
        $quiz->description = $request->description;
        $quiz->total_questions = $request->total_question;
        $quiz->status = $request->status;

        $return = $quiz->save();

        if ($return){
            return response([
                'status' => 'success',
                'title' => 'Successfully Added.',
                'text' => 'New Quiz Added to your list',
            ]);
        }else{
            return response([
                'status' => 'error',
                'title' => 'Error!!',
                'text' => 'Error While Adding!!',
            ]);
        }
    }

    public function edit($id)
    {
        $quiz = ExaminerQuiz::find($id);
        $class_contents = Content::where('parent_id',0)->get();

        $subject_id = Content::where( 'id', $quiz->subject_id )->first();
        $class_id = Content::where( 'id', $subject_id->parent_id )->first();

        $contents = $class_id->children; //providing initial subjects for select field in edit form

        $content_id = [
            'subject_id' => $subject_id->id,
            'class_id' => $class_id->id,
        ];
        return view('examiner.quiz.edit', compact('quiz','class_contents','content_id','contents'));
    }

    public function update(Request $request)
    {
        $quiz_id = $request->quiz_id;
        $quiz = ExaminerQuiz::where('id', $quiz_id)->first();
        $quiz->title = $request->title;
        $quiz->time = $request->time;
        $quiz->description = $request->description;
        $quiz->total_question = $request->total_question;
        $quiz->status = $request->status;

        $return = $quiz->Update();

        if ($return){
            return response([
                'status' => 'success',
                'title' => 'Successfully Update.',
                'text' => 'Quiz Updated From Your List!!',
            ]);
        }else{
            return response([
                'status' => 'error',
                'title' => 'Error!!',
                'text' => 'Error While Updating!!',
            ]);
        }
    }

    public function changeStatus($id){

        $quiz = ExaminerQuiz::find($id);
        if($quiz->status == 1){
            $quiz->status = 0;
        }else{
            $quiz->status = 1;
        }
        $return = $quiz->update();

        if($return){


            return response([
                'status' => 'success',
            ]);
        }
    }

    public function destroy($id)
    {
        $quiz = ExaminerQuiz::find($id);
        $return = $quiz->delete();
        if ($return){
            return response([
                'status' => 'Success',
                'title' => 'Deleted',
                'text' => 'Quiz Deleted From Your List!!',
            ]);
        }else{
            return response([
                'status' => 'error',
                'title' => 'Error!!',
                'text' => 'Error While Deleting!!',
            ]);
        }
    }
}
