<?php

namespace App\Model;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends Model
{
    use SoftDeletes;
    use Sluggable;

    protected $fillable = [
        'title',
        'file',
        'chapter_id',
        'status',
    ];



    public function chapter(){

        return $this->belongsTo(Content::class, 'chapter_id', 'id');
    }

    public function bookmark()
    {
        return $this->morphMany(BookMark::class, 'bookmark');
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
