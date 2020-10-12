<?php

namespace App\Http\Controllers\admin;

use App\Model\Content;
use App\Model\MarksWeightage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GobalController extends Controller
{


    public function changeNoteContent(Request $request){

      $id = $request->id;
      $type = $request->type;

      $contents = Content::where('parent_id', $id)->get();
      if($type == 'class'){
            return view('admin.note.select-subject', compact('contents'));
      }
        if($type == 'subject'){
            return view('admin.note.select-chapter', compact('contents'));
        }

        return null;

    }

    public function changeFlashCardContent(Request $request){

        $id = $request->id;
        $type = $request->type;

        $contents = Content::where('parent_id', $id)->get();
        if($type == 'class'){
            return view('admin.flashcard.select-subject', compact('contents'));
        }
        if($type == 'subject'){
            return view('admin.flashcard.select-chapter', compact('contents'));
        }

        return null;

    }

    public function changeSyllabusContent(Request $request){

        $id = $request->id;
        $type = $request->type;

        $contents = Content::where('parent_id', $id)->get();
        if($type == 'class'){
            return view('admin.flashcard.select-subject', compact('contents'));
        }
        if($type == 'subject'){
            return view('admin.flashcard.select-chapter', compact('contents'));
        }

        return null;

    }

    public function changeQuestionContent(Request $request){

        $id = $request->id;
        $type = $request->type;

        if($type == 'class'){
            $contents = Content::where('parent_id', $id)->get();
            return view('admin.questions.select-subject', compact('contents'));
        }
        if($type == 'subject'){
            $contents = Content::where('parent_id', $id)->get();
            return view('admin.questions.select-chapter', compact('contents'));
        }
        if($type == 'chapter'){
            $contents = MarksWeightage::where('chapter_id',$id)->get();
            return view('admin.questions.select-marks', compact('contents'));
        }

        return null;

    }

}
