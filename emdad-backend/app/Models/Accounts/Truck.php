<?php

namespace App\Models\Accounts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Truck extends Model
{
    use HasFactory , SoftDeletes;
    protected $fillable = [
        'name','type', 'class', 'color', 'model','size', 'brand'
    ];

    public function truck_image()
    {
        return $this->hasMany(Truck_image::class);
    }
    
}
