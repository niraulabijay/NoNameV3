<?php

namespace App\Http\Controllers\admin;

use App\Model\Content;
use App\Model\QuestionSet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class QuestionSetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getJson(){
        $notes = QuestionSet::all();
        $count = 1;
        foreach ($notes as $note){
            $note->count = $count;
            $note->date = $note->created_at->format('Y-M-d');
            $note->note_file = asset($note->file);
            $count++;
        }
        return datatables($notes)->toJson();
    }




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contents = Content::where( 'parent_id', 0 )->get();

        return view('admin.questionset.index', compact('contents'));
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $note = new QuestionSet();
        $note->title = $request->title;
        $note->status = $request->status;
        $note->subject_id = $request->subject_id;

        if ($request->hasFile('file'))
        {

            $img=$request->file;
            $fileName = time().".".$img->getClientOriginalExtension();
            $destinationPath=public_path('questionset/');
            $img->move($destinationPath, $fileName);
            $note->file='questionset/'.$fileName;

        }
        $return = $note->save();

        if($return){

            return response([
                'status' => 'success',
                'title' => 'Successfully Added.',
                'text' => 'Note Successfully Added to  Your List!!',
            ]);
        }else{
            return response([
                'status' => 'error',
                'title' => 'Error!!',
                'text' => 'Error While Adding!!',
            ]);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $note = QuestionSet::find($id);
        $contents = Content::where( 'parent_id', 0 )->get();

        $chapter_id = Content::where( 'id', $note->chapter_id )->first();
        $subject_id = Content::where( 'id', $chapter_id->parent_id )->first();
        $class_id = Content::where( 'id', $subject_id->parent_id )->first();

        $content_id = [
            'subject_id' => $subject_id->id,
            'class_id' => $class_id->id,
        ];


        return view('admin.questionset.edit', compact('note', 'contents', 'content_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $note = QuestionSet::where('id', $request->note_id)->first();
        $note->title = $request->title;
        $note->status = $request->status;
        $note->subject_id = $request->subject_id;

        if ($request->hasFile('file'))
        {
            if ($note->file){
                File::delete(public_path($note->file));
            }

            $img=$request->file;
            $fileName = time().".".$img->getClientOriginalExtension();
            $destinationPath=public_path('questionset/');
            $img->move($destinationPath, $fileName);
            $note->file='questionset/'.$fileName;

        }
        $return = $note->update();

        if($return){

            return response([
                'status' => 'success',
                'title' => 'Successfully Updated.',
                'text' => 'Note Successfully Updated From  Your List!!',
            ]);
        }else{
            return response([
                'status' => 'error',
                'title' => 'Error!!',
                'text' => 'Error While Updating!!',
            ]);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $note = QuestionSet::find($id);
        $return = $note->delete();
        if ($return){
            return response([
                'status' => 'Success',
                'title' => 'Deleted',
                'text' => 'User Deleted From Your List!!',
            ]);
        }else{
            return response([
                'status' => 'error',
                'title' => 'Error!!',
                'text' => 'Error While Deleting!!',
            ]);
        }
    }

    public function changeStatus($id){

        $note = QuestionSet::find($id);
        if($note->status == 1){
            $note->status = 0;
        }else{
            $note->status = 1;
        }
        $return = $note->update();

        if($return){

            return response([
                'status' => 'success',
            ]);
        }
    }
}
