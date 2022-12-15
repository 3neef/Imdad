<?php

namespace App\Http\Resources\CategoryResourses\category;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            "nameEn" => $this->name_en,
            "nameAr" => $this->name_ar,
            'aproved' => $this->aproved,
            'parentId' => $this->parent_id,
            'profileId' => $this->profile_id,
            'isleaf' => $this->isleaf,

        ];
    }
}