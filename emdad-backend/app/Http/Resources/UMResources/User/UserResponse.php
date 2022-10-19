<?php

namespace App\Http\Resources\UMResources\User;

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
            "roleId"=>$this->role_id,
            "companyId"=>$this->company_id,
            "mobile"=>$this->mobile,
            "isSuperAdmin"=>$this->is_super_admin,
            "otp"=>$this->otp,
            "otpExpiresAt"=>$this->otp_expires_at
        ];
    }
}
