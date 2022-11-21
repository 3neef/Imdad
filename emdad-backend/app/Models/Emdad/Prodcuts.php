<?php

namespace App\Models\Emdad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Prodcuts extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['id', 'name','measruing_unit','categories_id','price','company_id','image'];
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




