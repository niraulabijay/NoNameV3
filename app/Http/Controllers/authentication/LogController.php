<?php

namespace App\Http\Controllers\authentication;

use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;

class LogController extends Controller
{
    public function login()
    {
        return view('authentication.admin_login');
    }

    public function check(Request $request)
    {
//        dd($request);
        try {
            $rememberMe=false;
            if($request->rememberMe ==1){
                $rememberMe=true;
            }
            if (Sentinel::authenticate($request->all(), $rememberMe)) {
                if (Sentinel::getUser()->roles->first()->slug == "admin" || Sentinel::getUser()->roles->first()->slug == "developer") {
                    return response()->json(['redirect' =>'/admin/dashboard']);
                }elseif (Sentinel::getUser()->roles->first()->slug == "teacher" || Sentinel::getUser()->roles->first()->slug == "developer") {
                    return response()->json(['redirect' =>'/examiner']);
                } else {
                    return response()->json(['redirect' =>'/']);
                }
            } else {
                return response()->json(['error' => 'Wrong Credentials'], 500);
            }
        } catch (ThrottlingException $e) {
            $delay = $e->getDelay();
            return response()->json(['error' => 'You have been banned for ' . $delay . ' seconds'],500);
        } catch (NotActivatedException $e) {
            return response()->json(['error' => 'Account Not activated'],500);
        }

    }

    public function logout()
    {
        Sentinel::logout();
        return redirect('/');
    }

    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }


    public function handleProviderCallback($service)
    {
        $client = Socialite::driver($service)->user();

//        check if the user already exists
        $user = User::where('google_id', $client->getId())->first();


        if (!$user) {
//        add user to database
            $user = Sentinel::registerAndActivate(array(
                'name' => $client->getName(),
                'email' => $client->getEmail(),
                'google_id' => $client->getId(),
            ));
        }
//        log the user in
//        Auth::login($user, true);
        Sentinel::authenticate($user, false);
        return redirect('/');


    }
}
