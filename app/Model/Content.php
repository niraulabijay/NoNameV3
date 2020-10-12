<?php

namespace App\Model;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Content extends Model
{
    use sluggable;
    use SoftDeletes;
    protected $table="contents";

    protected $fillable=[
        'name','slug','type','parent_id','code', 'icon', 'time','is_learn', 'is_test', 'is_practice',
    ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function type(){
        return $this->belongsTo(Category::class,'type');
    }

    public function children(){
        return $this->hasMany(Content::class,'parent_id');
    }

    public function parent(){
        return $this->belongsTo(Content::class,'parent_id');
    }

    public function notes(){
        return $this->hasMany(Note::class, 'chapter_id', 'id');
    }

    public function flshCards(){
        return $this->hasMany(FlashCard::class, 'chapter_id', 'id');
    }

    public function questions(){

        return $this->hasMany(Question::class, 'chapter_id', 'id');
    }

    public function marks_weightages(){
        return $this->hasMany(MarksWeightage::class,'chapter_id');
    }

    public function questionSets(){
        return $this->hasMany(QuestionSet::class,'subject_id', 'id');
    }

    public function syllabus(){
        return $this->hasOne(Syllabus::class,'subject_id');
    }

}
