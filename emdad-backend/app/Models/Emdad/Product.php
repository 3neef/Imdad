<?php

namespace App\Models\Emdad;
use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    
    use HasFactory, SoftDeletes , LogsActivity,InteractsWithMedia;
    protected $table = "products";
    protected $fillable = ['created_by','profile_id','name_en','name_ar','description_en','description_ar', 'measruing_unit', 'category_id', 'price','image'];
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
        return $this->hasMany(unit_measruing::class);
    }

    public function companyProduct()
    {
        return $this->belongsToMany(Profile::class, 'profile_products_pivots', 'profile_id', 'product_id')
            ->withPivot('product_id')
            ->withTimestamps();
    }

}
