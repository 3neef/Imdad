<?php

namespace App\Http\Resources\CategoryResourses\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResponse extends JsonResource
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
            "nameEn" =>$this->name_en,
            "nameAr" =>$this->name_ar,
            "price" =>$this->price,
            'imags'=>$this->image,
            'descriptionEn'=>$this->description_en,
            'descriptionAr'=>$this->description_ar,
            'measruingUnit'=>$this->measruing_unit
        ];
    }
}
