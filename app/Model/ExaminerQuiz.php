<?php

namespace App\Model;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExaminerQuiz extends Model
{
    use Sluggable;
    use SoftDeletes;

    protected $fillable =[
        'title',
        'slug',
        'examiner_id',
        'subject_id',
        'time',
        'description',
        'total_questions',
        'time',
        'premium',
        'status',
    ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function examiner(){
        return $this->belongsTo(Examiner::class,'examiner_id');
    }

    public function questions(){
        return $this->belongsToMany(Question::class,'examiners_quiz_questions');
    }

}
