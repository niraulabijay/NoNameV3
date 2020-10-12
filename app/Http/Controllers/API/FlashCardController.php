<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\FlashCard\ChapterWithFlashCardsResource;
use App\Http\Resources\FlashCard\SingleFlashCardResource;
use App\Model\Content;
use App\Http\Controllers\Controller;
use App\Model\FlashCard;

class FlashCardController extends Controller
{
    public function index($subject_slug){

        $subject = Content::where('slug', $subject_slug)->first();
        $chapters = Content::where('parent_id', $subject->id)->get();
        return [
            'subject_name' => $subject->name,
            'chapter_count' => $subject->children()->count(),
            'subjects' => ChapterWithFlashCardsResource::collection($chapters),
        ];

    }

    public function show($id){
        $flashCard = FlashCard::where('id', $id)->first();
        return new SingleFlashCardResource($flashCard);

    }
}
