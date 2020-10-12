<?php

namespace App\Http\Controllers\admin;

use App\Model\Category;
use App\Model\Content;
use App\Model\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Answer;

class QuestionController extends Controller
{
    public function index()
    {
        $chap = Category::where('slug','chapter')->first();
        $chapters = $chap->contents;
//        dd($chapters);
        $questions = Question::all();
        return view('admin.questions.index',compact('questions','chapters'));
    }

    public function add(){
        $contents = Content::where( 'parent_id', 0 )->get();
        return view('admin.questions.question_add',compact('contents'));
    }

    public function store(Request $request){

        $question = Question::create([
            'name' => $request->question,
            'chapter_id' => $request->chapter_id,
            'marks' => $request->marks,
            'year' => serialize($request->year),
            'importance' => $request->importance,
        ]);
        if($request->hasFile('image')){
            $image = $request->file('image');
            $filename = time().'-question'.'.'.$image->getClientOriginalExtension();
            $image->move(public_path().'/admin/images/questions/',$filename);
            $db_filename = '/admin/images/questions/'.$filename;
            $question->image = $db_filename;
            $question->save();
        }
        $answers = $request->answer;
        foreach ($answers as $key => $answer){
            $correct = $request->correct == $key ? 1 : 0;
            $question->answers()->create([
                'name' => $answer,
                'correct' => $correct,
            ]);
        }
        return response()->json('Question Added Succeefully',200);
    }
    public function edit($id){
        $question = Question::findOrFail($id);
        $years = unserialize($question->year) ? unserialize($question->year) : null ;
        $contents = Content::where( 'parent_id', 0 )->get();
        return view('admin.questions.question_edit',compact('contents','question','years'));
    }

    public function update(Request $request, $id){
        // dd($request);
        try{
            $question = Question::find($id);
            $question->update([
                'name' => $request->question,
                'chapter_id' => $request->chapter_id,
                'marks' => $request->marks,
                'year' => $request->year ? serialize($request->year) : null,
                'importance' => $request->importance ? $request->importance : 0 ,
            ]);
            if($request->hasFile('image')){
                $image = $request->file('image');
                $filename = time().'-question'.'.'.$image->getClientOriginalExtension();
                $image->move(public_path().'/admin/images/questions/',$filename);
                $db_filename = '/admin/images/questions/'.$filename;
                $question->image = $db_filename;
                $question->save();
            }
            $answers = $request->answer;
            foreach ($answers as $key => $value){
                $answer = Answer::findOrFail($key);
                $correct = $request->correct == $key ? 1 : 0;
                $answer->update([
                    'name' => $value,
                    'correct' => $correct,
                ]);
            }
        }catch(\Exception $e){
            return response()->json('Question Add Failed',400);
        }
        return response()->json('Question Added Succeefully',200);
    }

    public function delete(Request $request){
        $question = Question::findOrFail($request->id);
        $question->delete();
        return redirect()->back()->with('success','Question Deleted Successfully');
    }
}
