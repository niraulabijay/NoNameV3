<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class NotificationUser extends Model
{
    protected $table="notification_users";

    protected $fillable = ['user_id','notification_id','seen'];

    public function notification(){
        return $this->belongsTo(Notification::class,'notification_id');
    }

    public function user(){
        return $this->belongs(User::class,'user_id');
    }
}
