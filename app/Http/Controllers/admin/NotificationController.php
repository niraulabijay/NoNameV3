<?php

namespace App\Http\Controllers\admin;

use App\Events\PushNotification;
use App\Model\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Content;
use App\Model\NotificationUser;
use App\Model\UserInfo;
use App\User;

class NotificationController extends Controller
{
    public function getJson(){
        $notifications = Notification::all();
        $count = 1;
        foreach ($notifications as $notification){
            $notification->count = $count;
            $notification->date = $notification->created_at->format('Y-M-d');
            $notification->type = $notification->pusher == 1 ? "Pusher" : "Class Users";
            $count++;
        }
        return datatables($notifications)->toJson();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes = Content::where('parent_id',0)->get();
        return view('admin.notification.index',compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        try{
            $message = $request->notification;
            $title = $request->title;

            $notification = new Notification();
            $notification->title = $title;
            $notification->notification = $message;

            if($request->pusher == 1){
                event(new PushNotification($title, $message));
                $notification->pusher = 1;
                $notification->save();
                return response([
                    'status' => 'success',
                    'title' => 'Successfull.',
                    'text' => 'Notification Successfully Sent as PUSHER Notification!!',
                ]);
            }else{
                $notification->save();
                $class_id = $request->class_id;
                $users_ids = UserInfo::where('content_id',$class_id)->pluck('user_id')->toArray();
                foreach($users_ids as $id){
                    NotificationUser::create([
                        'user_id'=>$id,
                        'notification_id' => $notification->id,
                        'seen' => 0,
                    ]);
                }
            }
        }catch(\Exception $e){
            return response([
                'status' => 'error',
                'title' => 'Error!!',
                'text' => 'Error While Sending!! '.$e->getMessage(),
            ]);
        }
        return response([
            'status' => 'success',
            'title' => 'Successfull.',
            'text' => 'Notification successfully sent to desired users!!',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $notification = Notification::find($id);
        return view('admin.notification.edit', compact('notification'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $message = $request->notification;
        $title = $request->title;
        $notification = Notification::where('id', $request->notification_id)->first();
        $notification->title = $title;
        $notification->notification = $message;

        if($notification->pusher == 1){
            return response([
                'status' => 'error',
                'title' => 'Cannot Edit!!',
                'text' => 'Pusher Notification ALready Sent.!!',
            ]);
        }


        $return = $notification->save();

        if($return){
            event(new PushNotification($title, $message));
            return response([
                'status' => 'success',
                'title' => 'Successfull.',
                'text' => 'Notification Edited Successfully!!',
            ]);
        }else{
            return response([
                'status' => 'error',
                'title' => 'Error!!',
                'text' => 'Error While Sending!!',
            ]);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $notification = Notification::find($id);
        $notif_user = NotificationUser::where('notification_id',$notification->id)->get();
        foreach($notif_user as $nu){
            $nu->delete();
        }
        $return = $notification->delete();
        if ($return){
            return response([
                'status' => 'Success',
                'title' => 'Deleted',
                'text' => 'Notification Deleted From Your List!!',
            ]);
        }else{
            return response([
                'status' => 'error',
                'title' => 'Error!!',
                'text' => 'Error While Deleting!!',
            ]);
        }
    }


}
