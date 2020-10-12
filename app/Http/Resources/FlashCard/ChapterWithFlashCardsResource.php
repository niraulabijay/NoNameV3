<?php

namespace App\Http\Resources\FlashCard;

use Illuminate\Http\Resources\Json\JsonResource;

class ChapterWithFlashCardsResource extends JsonResource
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
            'flashCards' => FlashCardResource::collection($this->flshCards)
        ];
    }
}
