<?php

namespace App\Http\Resources\AccountResourses\Company;

use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResponse extends JsonResource
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
            "id" =>$this->id,
            "name" =>$this->name,
            "companyId" =>$this->company_id,
            "companyType" =>$this->company_type,
            "companyVatId" =>$this->company_vat_id,
            "contactName" =>$this->contact_name,
            "contactPhone" =>$this->contact_phone,
            "contactEmail" =>$this->contact_email,
            "logoPath" =>$this->logo_path,
            "crPath" =>$this->cr_path,
            "vatPath" =>$this->vat_path,
            "isValidated" =>$this->is_validated,
            "crExpireData" =>$this->cr_expire_data,
            "subscriptionDetails" =>$this->subscription_details,
            "subscriptionid" =>$this->subs_id,
        ];
    }
}
