<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\Syllabus\SubjectResource;
use App\Http\Resources\Syllabus\SyllabusResource;
use App\Model\Category;
use App\Model\Content;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SyllabusController extends Controller
{
    public function overview($class_slug){
        $subject_type = Category::where('slug','subject')->first();
        $class = Content::where('slug',$class_slug)->first();
        $subjects = $subject_type->contents->where('parent_id', $class->id);
        return SubjectResource::collection($subjects);
    }

    public function get($subject_slug){
        $subject = Content::where('slug',$subject_slug)->first();
        return new SyllabusResource($subject->syllabus);
    }

    public function dashboard_syllabus($class_id){
        $subject_type = Category::where('slug','subject')->first();
        $class = Content::find($class_id);
        $subjects = $subject_type->contents->where('parent_id', $class->id);
        return SubjectResource::collection($subjects);
    }
}
