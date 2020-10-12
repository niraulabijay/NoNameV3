<?php

namespace App\Http\Controllers\API;

use App\Model\Category;
use App\Model\Content;
use App\Model\UserSession;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
class RegisterController extends Controller
{






    public function store1(Request $request){






//        check user exist or not
        $checkUser = User::where('phone', $request->phone)->first();
        if ($checkUser){
            $response = $this->checkUser($checkUser);
            return $response;
            }



        $user = new User();
        $user->name = $request->name;
        $user->phone = $request->phone;
        $userStoreReturn = $user->save();

        if ($userStoreReturn){
            $genOTP = substr(number_format(time() * rand(),0,'',''),0,6);
            $user->userOTP()->create([
                'user_id' => $user->id,
                'otp' => $genOTP,
            ]);

            $smsOTP = "http://api.allstarsms.com/?username=demo&password=allstar123&from=Allstar&to=".$user->phone."&text=".$genOTP."&type=1";
            $curl = curl_init();
        curl_setopt($curl,CURLOPT_URL, $smsOTP);
        $sms_response = curl_exec($curl);
            ob_end_clean();
        curl_close($curl);
        $sms_server_response =  json_decode($sms_response);
            if($sms_server_response){

                return response([
                    'status' => 'success',
                    'message' => 'Check Your Mobile Inbox for OTP.',
                    'user_id' => $user->id,
                    'server_message' => $sms_server_response,
                ]);
            }
        }else{
            return response([
                'status' => 'error',
                'message' => 'Somethings went error!!! please try again later',
            ]);
        }
        return response([
            'status' => 'error',
            'message' => 'Somethings went error!!! please try again later',
        ]);
    }


    public function checkUser($checkUser){
          if ($checkUser->user_verified_at == null){

            $genOTP = substr(number_format(time() * rand(),0,'',''),0,6);

                $checkUser->userOTP()->updateOrCreate(['user_id' => $checkUser->id],[
                    'user_id' => $checkUser->id,
                    'otp' => $genOTP,
                ]);
                $smsOTP = "http://api.allstarsms.com/?username=demo&password=allstar123&from=Allstar&to=".$checkUser->phone."&text=".$checkUser->userOTP->otp."&type=1";
                $curl = curl_init();
                curl_setopt($curl,CURLOPT_URL, $smsOTP);
                $sms_response = curl_exec($curl);
                ob_end_clean();
                curl_close($curl);

                $sms_server_response =  json_decode($sms_response);
                if($sms_server_response){

                    return response([
                        'status' => 'success',
                        'message' => 'Check Your Mobile Inbox for OTP.',
                        'user_id' => $checkUser->id,
                        'server_message' => $sms_server_response,
                    ], 201);
                }
            }else{
                return response([
                    'status' => 'error',
                    'message' => 'Your Phone Number Already Exist!!!',
                    'user_id' => $checkUser->id,
                ]);
            }
    }

    public function validateOTP(Request $request){

        if($request->user_id){
            $userID = $request->user_id;
            $user = User::find($userID);
            if($user) {
                if ($user->userOTP->otp == $request->otp) {
                    return response([
                        'status' => 'success',
                        'message' => 'OTP Successfully Match.',
                        'user_id' => $user->id,
                    ]);
                } else {
                    return response([
                        'status' => 'error',
                        'message' => 'OTP cannot Match.',
                        'user_id' => $user->id,
                    ]);
                }
            }else {
                return response([
                    'status' => 'error',
                    'message' => 'No User Found !!!',
                    'user_id' => null,
                ]);
            }
        }else{
            return response([
                'status' => 'error',
                'message' => 'No User Found !!!',
                'user_id' => null,
            ]);
        }

    }

    public function savePassword(Request $request){
        $user_id = $request->user_id;
        $user = User::where('id', $user_id)->first();
        if (!$user){
            return response()->json([
                'status'=>'error',
                'message'=>'User Not Found',
                'uer_id' => null,
            ], 201);
        }

        if($user->password){
            return response()->json([
                'status'=>'error',
                'message'=>'User already Register.. Reset Your Password',
                'uer_id' => null,
            ], 201);
        }
        $user->password = bcrypt($request->password);
        $success = $user->update();

        if($success){
            $request->merge(['phone' => $user->phone]);

            return $this->login($request);
            }else{


            return response([
                'msg' => 'False',
            ]);
        }

    }




    public function login(Request $request){




        $credentials = $request->only('phone', 'password');

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid Credentials',
                ], 400);
            }
        } catch (JWTException $e) {
            return response()->json([
                'status'=>'error',
                'message'=>'Token generation failed',
                'uer_id' => null,
            ], 500);
        }

        if($token){
            $user = User::where('phone', $request->phone)->first();
            $userSession = $user->userSession();
            $sessionCount = $userSession->count();

            if($sessionCount >= 10){
                $userSession->where('created_at', '<', Carbon::now()->subDays(1)->toDateTimeString())->delete();
                if($user->userSession()->count() >= 10){
                    return response([
                        'status' => 'error',
                        'message' => 'Already Login in 10 Device !!',
                    ]);
                }else{
                    return $this->loggedUser($user, $token);
                }
            }
            return $this->loggedUser($user, $token);


        }else{
        return response([
        'msg' => 'False',
        ]);
        }


    }


    public function loggedUser($user, $token){
        $user->userSession()->create([
            'token'=> $token
        ]);
        $className = null;
        if($user->userInfo){
            $content = Content::find($user->userInfo->content_id);
            $className = $content->name;
        }
        return response([
            'status' => 'success',
            'message' => 'User Successfully Loggedin',
            'name' =>$user->name,
            'user_id' => $user->id,
            'auth_token' => $token,
            'class_id' => $user->userInfo?$user->userInfo->content_id:null,
            'class_name' => $className,
        ]);
    }


    public function logout(Request $request){


        $this->validate($request, [
            'auth_token' => 'required'
        ]);

        try {

            $logout = JWTAuth::user()->userSession()->where('token', $request->auth_token)->delete();
            if($logout){
                JWTAuth::invalidate($request->auth_token);
                Auth::logout();
                return response()->json([
                    'status' => 'success',
                    'message' => 'User logged out successfully'
                ]);
            }else{
                return response()->json([
                    'status' => 'error',
                    'message' => 'Token is Invalid !!'
                ]);
            }

        } catch (JWTException $exception) {
            return response()->json([
                'status' => 'error',
                'message' => 'Sorry, the user cannot be logged out'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    public function changePassword(Request $request){
        $old_password = $request->old_password;
        $password = $request->password;
        $user = JWTAuth::user();

         if(Hash::check($old_password, $user->password)){

             $user->password = bcrypt($password);
             $user->update();
             return response([
                 'status' => 'success',
                 'message' => 'Password Successfully Changed.',
             ]);

         }else{
             return response([
                 'status' => 'error',
                 'message' => 'Old Password doesnt Match!!!',
             ]);
         }


        return response([
            'status' => 'error',
            'message' => null,
        ]);
    }


}



