<?php

namespace App\Http\Resources\AnswerWithoutCorrect;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\AnswerWithoutCorrect\AnswerResource;

class QuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'image' => isset($this->image) && $this->image!="" ? '127.0.0.1:8000'.$this->image : "",
            'marks' => $this->marks,
            'chapter_id' => $this->chapter_id,
            'importance' => $this->importance,
            'year' => unserialize($this->year),
            'answers' => AnswerResource::collection($this->answers),
        ];
    }
}
