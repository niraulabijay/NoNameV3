<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use App\Model\PractiseLog;
use App\Model\Content;
use Carbon\Carbon;

class PractiseQuota
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
        $user_id = JWTAuth::user()->id;
        $chapter_slug = $request->route('chapter_slug');
        $chapter = Content::where('slug',$chapter_slug)->first();
        $practise = PractiseLog::where('user_id', $user_id)->where('chapter_id',$chapter->id)->where('created_at', '>=', Carbon::now()->subDay(1))->first();
        if($practise) {
            $data = unserialize($practise->question_answer);
            if (count($data) > 10) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Today Quota is Completed!!',
                ]);
            }
        }
        return $next($request);
    }
}
