<?php

namespace App\Models\Emdad;
use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Product extends Model
{
    use HasFactory, SoftDeletes , LogsActivity;
    protected $table = "products";
    protected $fillable = ['name', 'measruing_unit', 'category_id', 'price','image'];
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty();
    }
    public function category()
    {
        return $this->belongsTo(Categories::class);
    }


    public function unit_measruing()
    {
        return $this->belongsTo(unit_measruing::class,'measruing_unit');
    }

    public function companyProduct()
    {
        return $this->belongsToMany(Profile::class, 'profile_products_pivots', 'profile_id', 'product_id')
            ->withPivot('product_id')
            ->withTimestamps();
    }

}
