<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Notification\NotificationResource;
use App\Model\Notification;
use App\Model\NotificationUser;
use JWTAuth;

class NotificationController extends Controller
{
    public function getNotifications(){
        try{
            $user_id = JWTAuth::user()->id;
            $seen_notification_user = NotificationUser::where('user_id',$user_id)
                ->where('seen',1)
                ->orderBy('created_at','desc')
                ->get()->take(10)->plucK('notification_id')->toArray();
            $seen = Notification::whereIn('id',$seen_notification_user)->orderBy('created_at','desc')->get();
            $unseen_notification_user = NotificationUser::where('user_id',$user_id)
                ->where('seen',0)
                ->orderBy('created_at','desc')
                ->get()->take(10)->plucK('notification_id')->toArray();
            $unseen = Notification::whereIn('id',$unseen_notification_user)->orderBy('created_at','desc')->get();

        }catch(\Exception $e){
            return [
                'status' =>'error',
                'message' => $e->getMessage()
            ];
        }
        return [
            'seen_notifications'=>NotificationResource::collection($seen),
            'unseen_notifications'=>NotificationResource::collection($unseen),
        ];

    }

    public function getUnseenNotificationCount(){
        try{
            $user_id = JWTAuth::user()->id;
            $unseen_notification_count = NotificationUser::where('user_id',$user_id)
                ->where('seen',0)
                ->orderBy('created_at','desc')
                ->count();
            if($unseen_notification_count > 10){
                $return = "10+";
            }else{
                $return = $unseen_notification_count;
            }
        }catch(\Exception $e){
            return [
                'status' =>'error',
                'message' => $e->getMessage()
            ];
        }
        return [
            'status' => 'success',
            'unseen_notifications' => $return,
        ];

    }

    public function markSeenNotifications(Request $request){
        try{
            $user_id = JWTAuth::user()->id;
            $unseen_ids = json_decode($request->unseen_id);
            $count = 0;
            foreach($unseen_ids as $id){
                $notif_user = NotificationUser::where('user_id',$user_id)->where('notification_id',$id)->first();
                $notif_user->seen = 1;
                $notif_user->save();
                $count ++;
            }

        }catch(\Exception $e){
            return [
                'status' =>'error',
                'message' => $e->getMessage()
            ];
        }
        return [
            'status' => "success",
            'msg' => $count." notifications seen by user"
        ];
    }
}
