<?php

namespace App\Http\Resources\CategoryResourses\category;

use App\Models\Emdad\Categories;
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
            'status' => $this->status,
            'parentId' => $this->parent_id,
            'profileId' => $this->profile_id,
            'isleaf' => $this->isleaf,
            'type' => $this->type,
            'note' =>$this->reason,
            'createdAt'=>$this->created_at??null,
            'CeatedBy'=>$this->created_by??null,
            'categoryId'=>$this->category_id??null,
            'sequence'=>Categories::where("id",$this->id)->first()!=null?Categories::where("id",$this->id)->first()->sequence():"debug"
        ];
    }
}
