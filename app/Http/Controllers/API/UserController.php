<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\User\UserResource;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{

    public function getData($id){

        $user = User::where('id', $id)->first();
        if($user){
            return response()->json([
                'status' => 'success',
                'user' => new UserResource($user),
            ]);
        }else{
            return response()->json([
                'status' => 'error',
                'user' =>null
            ]);
        }
    }

    public function storeData(Request $request){

//        return $request;
        $user = User::where('id', $request->user_id)->first();
        $user->name = $request->name;
        $response = $user->update();

        if ($request->hasFile('profile_image'))
        {
            $img=$request->profile_image;
            $fileName=time().".".$img->getClientOriginalExtension();
            $destinationPath=public_path('user/profile/');
            $img->move($destinationPath, $fileName);
            $profile_imaage='user/profile/'.$fileName;
        }
        if($response){
            $user->userInfo()->updateOrCreate(
                ['user_id' => $user->id],
                [
                    'gender' => $request->gender,
                    'DOB' => $request->dob,
                    'content_id' => $request->class_id,
                    'address' => $request->address,
                    'profile_image' => $profile_imaage,
                    'institution' => $request->institution,
                ]
            );

            return response()->json([
                'status' => 'success',
                'message' => 'User Successfully Updated',
                'user' => new UserResource($user),
            ]);
        }else{
            return response()->json([
                'status' => 'error',
                'user' =>null
            ]);
        }
    }
}
