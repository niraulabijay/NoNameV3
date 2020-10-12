<?php

namespace App\Http\Resources\Practise;

use App\Http\Resources\Answer\AnswerResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PractiseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if($this->image && file_exists(public_path().'/'. $this->image)) {
            $image = 'http://noname.hellonep.com/'.$this->image;
        }
        else{
            $image = null;
        }
        return [
            'id'=> $this->id,
            'name' => $this->name,
            'image' => $image,
            'chapter_id' => $this->chapter->id,
            'marks' => $this->marks,
            'answers' => AnswerResource::collection($this->answers)
        ];
    }
}
