<?php

namespace App\Http\Resources\UMResourses\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResponse extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id"=>$this->id,
            "name"=>$this->name,
            "email"=>$this->email,
            "type"=>$this->type,
            "loginOtp"=>$this->login_otp,
            "otpExpiresAt"=>$this->otp_expires_at,
        ];
    }
}
