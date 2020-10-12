<?php

namespace App\Http\Resources\Chapter;
use App\Model\PractiseLog;
use App\Model\Question;
use JWTAuth;
use Illuminate\Http\Resources\Json\JsonResource;

class ChapterResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'code' => $this->code,
            'percentage' => getPractiseLog($this->id),

        ];
    }


}
