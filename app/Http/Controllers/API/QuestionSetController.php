<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\QuestionSet\QuestionSetResource;
use App\Model\Content;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuestionSetController extends Controller
{
    public function index($subject_slug){

        $subject = Content::where('slug', $subject_slug)->first();
        return [
            'subject_name' => $subject->name,
            'chapter_count' => $subject->children()->count(),
            'subjects' => QuestionSetResource::collection($subject->questionSets),
        ];

    }
}
