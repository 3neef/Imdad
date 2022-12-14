<?php

namespace App\Models\Emdad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "products";
    protected $fillable = ['name', 'measruing_unit', 'category_id', 'price', 'profile_id', 'image'];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function category()
    {
        return $this->belongsTo(Categories::class);
    }


    public function unit_measruing()
    {
        return $this->hasMany(unit_measruing::class);
    }
}
