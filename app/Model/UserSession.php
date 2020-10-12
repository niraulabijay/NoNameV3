<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class UserSession extends Model
{
    protected $fillable = [
      'user_id',
      'token',
    ];


    public function User(){

        return $this->belongsTo(User::class, 'user_id');
    }
}
