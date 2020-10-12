<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class QuestionSet extends Model
{
    protected $fillable = [
        'title',
        'file',
        'subject_id',
        'status',
    ];



    public function subject(){

        return $this->belongsTo(Content::class, 'subject_id', 'id');
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
