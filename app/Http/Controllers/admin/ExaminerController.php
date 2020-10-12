<?php

namespace App\Http\Controllers\admin;

use App\model\Examiner;
use App\Model\SystemUser;
use App\User;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExaminerController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index(){
        $role = Sentinel::findRoleBySlug('teacher');
        $users = $role->users()->with('roles')->get();
        return view('admin.examiner.assign', compact('users'));
    }

    public function changeStatus($id)
    {
        $user = SystemUser::findOrFail($id);
        if(isset($user->examiner)){
            $exm = $user->examiner;
            $exm->status = $exm->status == 1 ? 0 : 1;
            $exm->save();
        }
        else{
            $user->examiner()->create([
                'status'=>1
            ]);
        }
        return redirect()->back();
    }
}
