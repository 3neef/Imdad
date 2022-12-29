<?php

namespace App\Models\Emdad;
use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "products";
    protected $fillable = ['name', 'measruing_unit', 'category_id', 'price','image'];
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

    public function companyProduct()
    {
        return $this->belongsToMany(Profile::class, 'profile_products_pivots', 'profile_id', 'product_id')
            ->withPivot('product_id')
            ->withTimestamps();
    }

}
