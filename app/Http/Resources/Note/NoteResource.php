<?php

namespace App\Http\Resources\Note;

use Illuminate\Http\Resources\Json\JsonResource;

class NoteResource extends JsonResource
{

    public function toArray($request)
    {
        if($this->bookmark->where('user_id',$request->user_id)->first() != null)  $bookmark = 1;
        else $bookmark = 0;
        return [
            'id' => $this->id,
            'title' => $this->title,
            'bookmark' => $bookmark,
        ];
    }
}
