<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Examiner extends Model
{
    protected $fillable = [
        'user_id','name','occupation','institution','status',
    ];

    public function user(){
        return $this->belongsTo(SystemUser::class,'user_id');
    }

    public function quizzes(){
        return $this->hasMany(ExaminerQuiz::class,'examiner_id');
    }
}
