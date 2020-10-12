<?php

namespace App\Http\Resources\FlashCard;

use Illuminate\Http\Resources\Json\JsonResource;

class SingleFlashCardResource extends JsonResource
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
            'description' => $this->description,
            'chapter_id' => $this->chapter_id,
            'chapter_name' => $this->chapter->name
        ];
    }
}
