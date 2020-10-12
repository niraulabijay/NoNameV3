<?php

namespace App\Model;

use Cartalyst\Sentinel\Users\EloquentUser;
use Illuminate\Database\Eloquent\Model;

class SystemUser extends EloquentUser
{
    public function examiner(){
        return $this->hasOne(Examiner::class,'user_id');
    }
}
