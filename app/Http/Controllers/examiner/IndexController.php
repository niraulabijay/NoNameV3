<?php

namespace App\Http\Controllers\examiner;

use Cartalyst\Sentinel\Sentinel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function dashboard(){
        return view('examiner.index');
    }


    public function profile(){
        return view('examiner.profile.index');
    }

    public function inactive(){
        if(!\Sentinel::check()){
            abort(404);
        }
        return view('examiner.inactive');
    }
}
