<?php

namespace App\Http\Resources\UMResources\Permission;

use Illuminate\Http\Resources\Json\JsonResource;

class PermissionResponse extends JsonResource
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
            "label" =>$this->label, 
            "description" =>$this->description,
        ];
    }
}
