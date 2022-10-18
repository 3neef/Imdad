<?php

namespace App\Http\Resources\AccountResourses\Location;

use Illuminate\Http\Resources\Json\JsonResource;

class LocationResponse extends JsonResource
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
            "companyId" =>$this->company_id, 
            "warehouseName" =>$this->address_name,
            "warehouseType" =>$this->address_type,
            "gateType" =>$this->gate_type,
            "location" =>$this->latitude_longitude,
            "receiverName" =>$this->address_contact_name,
            "receiverPhone" =>$this->address_contact_phone,
            "otpVerfied" =>$this->otp_verfied,
            "confirmBy" =>$this->confirm_by,
        ];
    }
}
