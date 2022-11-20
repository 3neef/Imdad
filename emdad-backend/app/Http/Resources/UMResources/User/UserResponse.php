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
            "firstName"=>$this->first_name,
            "lastName"=>$this->last_name,
            "fullName"=>$this->full_name,
            "identityNumber"=>$this->identity_number,
            "identityType"=>$this->identity_type,
            "email"=>$this->email,
            "mobile"=>$this->mobile,
            "isSuperAdmin"=>$this->is_super_admin
        ];
    }
}
