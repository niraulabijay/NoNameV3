<?php

namespace App\Http\Middleware;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Closure;

class TeacherMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Sentinel::check())
        {
            $user = Sentinel::getUser();
            $roles = $user->getRoles()->pluck('slug')->toArray();
            if(in_array('teacher',$roles)) {
                if(!$user->examiner || $user->examiner->status == 0){
                    return redirect()->route('examiner.in_active');
                }
                return $next($request);
            }
            else
            {
                return redirect('/');
            }
        }
        else
        {
            return redirect('/');
        }
    }
}
