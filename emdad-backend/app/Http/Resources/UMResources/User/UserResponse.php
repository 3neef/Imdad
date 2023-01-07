<?php

namespace App\Http\Resources\UMResources\User;

use App\Http\Resources\AccountResourses\Profile\ProfileResponse;
use App\Models\UM\RoleUserProfile;
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
            "id" => $this->id,
            "fullName" => $this->full_name,
            "identityNumber" => $this->identity_number,
            "identityType" => $this->identity_type,
            "email" => $this->email,
            "mobile" => $this->mobile,
            "otp" => $this->otp,
            "isSuperAdmin" => $this->is_super_admin,
            "status" => $this->userStatus() != null ? $this->userStatus()->status : "",
            "roleId" => $this->userRole() ?? '',
            "profileId" => $this->currentProfile() != null ? new ProfileResponse($this->currentProfile()) : null,
            "expireDate" => $this->expiry_date,
            "passwordChanged" => $this->password_changed,
            "MangerInfo" => $this->mangerUserId() ?? '',
            "allProfiles"=> RoleUserProfile::where("user_id",$this->id)->pluck("profile_id")->get()

        ];
    }
}
