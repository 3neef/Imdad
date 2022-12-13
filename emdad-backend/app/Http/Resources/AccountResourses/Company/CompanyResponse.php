<?php

namespace App\Http\Resources\AccountResourses\Company;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResponse extends JsonResource
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
            "name" => $this->name_ar,
            "companyId" => $this->profile_id,
            "companyType" => $this->type,
            "companyVatId" => $this->vat_number,
            "CrExpiredDate" => $this->cr_expire_data,
            "isValidated" => $this->active,
            "crExpireData" => $this->cr_expire_data,
            "subscriptionDetails" => $this->subscription_details,
            "subscriptionid" => $this->subs_id,
            "iban" => $this->iban,
            "bank" => $this->bank,
            "swift" => $this->swift,
            "createdBy" => $this->crreated_by,
        ];
    }
}
