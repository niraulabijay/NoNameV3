<?php

namespace App\Http\Resources\FlashCard;

use App\Model\Content;
use Illuminate\Http\Resources\Json\JsonResource;

class FlashCardResource extends JsonResource
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
            'title' => $this->title,
            'slug' => $this->slug,
        ];
    }
}



