<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PractiseLog extends Model
{
    protected $fillable = ['user_id', 'question_answer','chapter_id'];
}
