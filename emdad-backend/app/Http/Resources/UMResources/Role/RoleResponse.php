<?php

namespace App\Http\Resources\UMResourses\Role;

use Illuminate\Http\Resources\Json\JsonResource;

class RoleResponse extends JsonResource
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
            "type" =>$this->type, 
        ];
    }
}
