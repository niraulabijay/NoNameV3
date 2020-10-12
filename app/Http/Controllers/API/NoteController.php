<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\Note\ChapterWithNotesResource;
use App\Http\Resources\Note\NoteCollection;
use App\Http\Resources\Note\NoteResource;
use App\Http\Resources\Note\SingleNoteResource;
use App\Model\Content;
use App\Model\Note;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NoteController extends Controller
{

    public function index($user_id,$subject_slug)
    {
//        $user = User::find($user_id);
        $subject = Content::where('slug', $subject_slug)->first();
        $chapters = Content::where('parent_id', $subject->id)->get();
        return [
            'subject_name' => $subject->name,
            'chapter_count' => $subject->children()->count(),
            'subjects' => ChapterWithNotesResource::collection($chapters),
        ];
    }


    public function show($id){
        $note = Note::where('id', $id)->first();
        return new SingleNoteResource($note);

    }
}
