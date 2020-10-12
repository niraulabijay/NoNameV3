<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'user_id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'class' => $this->userInfo->Content->name,
            'profile_image' => asset($this->userInfo->profile_image),
            'dob' => $this->userInfo->DOB,
            'gender' => $this->userInfo->gender,
            'institution' => $this->userInfo->institution,
            'address' => $this->userInfo->address,
        ];
    }
}
