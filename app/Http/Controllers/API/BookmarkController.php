<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\Note\ChapterWithNotesResource;
use App\Http\Resources\Note\NoteResource;
use App\Model\BookMark;
use App\Model\Content;
use App\Model\Note;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookmarkController extends Controller
{
    public function store(Request $request)
    {
//return $request;
        $note = Note::where('id', $request->note_id)->first();
//        dd($note);
        if ($note->bookmark->where('user_id',$request->user_id)->first()) {
            $note->bookmark->where('user_id',$request->user_id)->first()->delete();
            return response([
                'status' => 'success',
                'message' => 'Bookmarked Deleted Successfully.',
            ]);
        } else {
            $bookmark = new BookMark();
            $bookmark->user_id = $request->user_id;
            $response = $note->bookmark()->save($bookmark);

            if ($response) {
                return response([
                    'status' => 'success',
                    'message' => 'Bookmark Successfully Saved.',
                ]);
            } else {
                return response([
                    'status' => 'error',
                    'message' => 'Cannot BookMark.',
                ]);
            }
        }
    }

    public function note_bookmarks($user_id){
        $user = User::find($user_id);
        $bookmarked_note_ids = BookMark::where('user_id',$user->id)->where('bookmark_type','App\Model\Note')->pluck('bookmark_id');

        $notes = Note::whereIn('id', $bookmarked_note_ids)->get();
        $chapters = new Collection();
        foreach ($notes as $note){
            $chapter = $note->chapter;
            $chapters= $chapters->push($chapter);
        }

        return ChapterWithNotesResource::collection($chapters);
    }

}
