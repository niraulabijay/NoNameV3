<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Syllabus extends Model
{
    public function subject(){
        return $this->belongsTo(Content::class, 'subject_id');
    }
}
