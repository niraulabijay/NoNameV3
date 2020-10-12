<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class QuizLog extends Model
{
    public function subject(){
        return $this->belongsTo(Content::class,'subject_id');
    }
}
