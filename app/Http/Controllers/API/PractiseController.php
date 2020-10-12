<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\Answer\Answer;
use App\Http\Resources\Practise\PractiseResource;
use App\Http\Resources\Quiz\QuizResource;
use App\Model\Content;
use App\Model\PractiseLog;
use App\Model\Question;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use JWTAuth;

class PractiseController extends Controller
{
    public function index($chapter_slug){

        $chapter = Content::where('slug', $chapter_slug)->first();
        $questions = Question::where('chapter_id', $chapter->id)->get()->take(5);

        return PractiseResource::collection($questions);
    }


    public function storeData(Request $request){
        $user_id = JWTAuth::user()->id;
        $chapter_id = $request->chapter_id;
        $practise = PractiseLog::where('user_id', $user_id)->where('chapter_id',$chapter_id)->where('created_at', '>=', Carbon::now()->subDay(1))->first();

        if($practise){
            $data = unserialize($practise->question_answer);
            array_push($data,$request->data[0]);
            $practise->question_answer = serialize($data);
            $response = $practise->update();
        }else{
            $log = new PractiseLog();
            $log->user_id = $user_id;
            $log->chapter_id = $chapter_id;
            $log->question_answer = serialize($request->data);
            $response = $log->save();
        }

        if($response){
            return response()->json([
                'status' => 'success',
                'message' => 'Practise Log Successfully Added',
            ]);
        }else{
            return response()->json([
                'status' => 'error',
                'message' => 'Error While Adding!!',
            ]);
        }
    }



    public function returnTestData($data){

        $questions = new Collection();
        foreach ($data->practise as $item){
            $getquestion =  Question::where('id', $item['questionId'])->first();
          $getquestion->selected = $item['answerId'];
            $getquestion->questionAnswers = Answer::collection($getquestion->answers);
            $questions = $questions->push($getquestion);
        }

        return $questions->map->only(['id','name', 'selected', 'questionAnswers']);

    }

    public function getData(){

        $test = PractiseLog::find(8);
        return unserialize($test->question_answer);
    }

    public function practice_by_chapter($chapter_slug){
        $chapter = Content::where('slug', $chapter_slug)->first();
        $question = Question::where('chapter_id', $chapter->id)->inRandomOrder()->first();
        return new PractiseResource($question);
    }


}
