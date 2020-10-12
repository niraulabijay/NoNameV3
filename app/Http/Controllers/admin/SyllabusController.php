<?php

namespace App\Http\Controllers\admin;

use App\Model\Content;
use App\Model\Syllabus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SyllabusController extends Controller
{
    public function getJson(){
        $syllabi = Syllabus::all();
        $count = 1;
        foreach ($syllabi as $syllabus){
            $syllabus->count = $count;
            $syllabus->class_name = $syllabus->subject->parent->name;
            $syllabus->subject_name = $syllabus->subject->name;
            $syllabus->date = $syllabus->created_at->format('Y-M-d');
            $count++;
        }
        return datatables($syllabi)->toJson();
    }

    public function index(){
        $contents = Content::where( 'parent_id', 0 )->get();
//        $syllabi = Syllabus::all();
        return view('admin.syllabus.all_syllabus',compact('contents'));
    }

    public function store(Request $request)
    {

        $syllabus = new Syllabus();
        $syllabus->title = $request->title;
        $syllabus->status = $request->status;
        $syllabus->description = $request->description;
        $syllabus->subject_id = $request->subject_id;

        if ($request->hasFile('image'))
        {

            $img=$request->image;
            $fileName = time().".".$img->getClientOriginalExtension();
            $destinationPath=public_path('syllabus/');
            $img->move($destinationPath, $fileName);
            $syllabus->image='syllabus/'.$fileName;

        }
        $return = $syllabus->save();

        if($return){

            return response([
                'status' => 'success',
                'title' => 'Successfully Added.',
                'text' => 'Syllabus Successfully Added to  Your List!!',
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
        $syllabus = Syllabus::find($id);

        $contents = Content::where( 'parent_id', 0 )->get();


        $subject = Content::where( 'id', $syllabus->subject->id )->first();

        $subjectLists = Content::where( 'parent_id', $subject->parent_id )->get();

        $class = Content::where( 'id', $subject->parent_id )->first();
        return view('admin.syllabus.edit', compact('syllabus', 'contents', 'subject', 'subjectLists', 'class'));
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
        $syllabus = Syllabus::where('id', $request->syllabus_id)->first();
        $syllabus->title = $request->title;
        $syllabus->status = $request->status;
        $syllabus->description = $request->description;
        $syllabus->subject_id = $request->subject_id;


        $return = $syllabus->update();

        if($return){

            return response([
                'status' => 'success',
                'title' => 'Successfully Updated.',
                'text' => 'Syllabus Successfully Updated From  Your List!!',
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
        $syllabus = Syllabus::find($id);
        $return = $syllabus->delete();
        if ($return){
            return response([
                'status' => 'Success',
                'title' => 'Deleted',
                'text' => 'Syllabus Deleted From Your List!!',
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

        $syllabus = Syllabus::find($id);
        if($syllabus->status == 1){
            $syllabus->status = 0;
        }else{
            $syllabus->status = 1;
        }
        $return = $syllabus->update();

        if($return){

            return response([
                'status' => 'success',
            ]);
        }
    }
}
