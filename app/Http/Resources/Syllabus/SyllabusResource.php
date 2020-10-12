<?php

namespace App\Http\Resources\Syllabus;

use Illuminate\Http\Resources\Json\JsonResource;

class SyllabusResource extends JsonResource
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
            'subject' => $this->subject->name,
            'title' => $this->title,
            'description' => $this->description,
        ];
    }
}
