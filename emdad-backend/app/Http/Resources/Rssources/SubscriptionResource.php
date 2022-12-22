<?php

namespace App\Http\Resources\Rssources;

use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptionResource extends JsonResource
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
            'id'=>$this->id,
            'profileId'=>$this->profile_id,
            'packageId'=>$this->package_id,
            'userId'=>$this->user_id,
            'subTotal'=>$this->sub_total,
            'expireDate'=>$this->expire_date,
            'taxAmount'=>$this->tax_amount,
            'total'=>$this->total,
            'status'=>$this->status,
        ];
    }
}
