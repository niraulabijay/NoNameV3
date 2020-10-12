<?php

namespace App\Http\Controllers\admin;

use App\Model\Answer;
use App\Model\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class DashboardController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('admin');
    // }

    public function index(){
        return view('admin.index');
    }

    public function importExcel(Request $request)
    {
        // dd($request);
        if($request->hasFile('import_file')){
            $path = $request->file('import_file')->getRealPath();
//            dd($path);
            $data = Excel::load($path, function($reader) {})->get();
            //  dd($data);
            if(!empty($data) && $data->count()){
                // dd($data);
                $question_add_count = 0;
                foreach ($data->toArray() as $key => $v) {
                    if(!empty($v)){
                        // dd($v);
                        $question = new Question();
                        $question->name = $v['question'];
                        $question->marks = 1;
                        // $question->importance = (int)$v['importance'];
                        $question->chapter_id = (int)$v['chapter_id'];

                        // $year = json_decode($request->year);
                        // $question->year = serialize($year);

                        $question->save();

                        //setting answers
                        $options = [$v['option_a'],$v['option_b'],$v['option_c'],$v['option_d']];
                        $counter = 0;
                        $corrects = ["a","b","c","d"];
                        foreach ($options as $option){
                            $answer = new Answer();
                            $answer->name = $option;
                            $answer->question_id = $question->id;
                            if($corrects[$counter] == $v['correct']){
                                $answer->correct =1;
                            }
                            else{
                                $answer->correct =0;
                            }
                            $counter++;
                            $answer->save();
                        }
                        $question_add_count ++;
                    }
                }
                return "Questions added = ".$question_add_count;

            }
            return back()->with('error','Error with excel file.');
        }
        return back()->with('error','Please Check your file, Something is wrong there.');
    }

    public function getTableData(Request $request){
        dd(json_decode($request->question));
    }
}
