<?php

namespace App\Http\Resources\SetupResources;

use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptionPackageResource extends JsonResource
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
            "packageName"=>$this->subscription_name,
            "packageDetails"=>json_decode($this->subscription_details),
        ];
    }
}
