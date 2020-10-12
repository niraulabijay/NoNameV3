<?php

namespace App\Http\Resources\Subject;

use App\Model\Content;
use App\Model\QuizLog;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;
use JWTAuth;

class SubjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $user_id = JWTAuth::user()->id;
        $quizLog = QuizLog::where('user_id', $user_id)->where('subject_id',$this->id)->where('created_at', '>=', Carbon::now()->subDay(1))->get();

        return [

            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'code' => $this->code,
            'icon' => $this->icon,
            $this->mergeWhen($this->is_test == 1, [
                'ongoing' => $this->check_ongoing(),
                'attempt' =>$quizLog->count(),
                'remaining' =>20 - $quizLog->count(),
                'time' => $this->time,
                'percentage' => getsubjectPercentage($this->id),
            ]),
        ];
    }


    private function check_ongoing(){
        $current_time = Carbon::now('Asia/Kathmandu')->format('Y-m-d H:i:s');
        $user_id = JWTAuth::user()->id;
        $log = QuizLog::where('subject_id',$this->id)->where('user_id',$user_id)->where('quit',0)->where('end_time','>=',$current_time)->where('completed',0)->first();
        if($log){
            return 1;
        }
        else{
            return 0;
        }
    }

}
