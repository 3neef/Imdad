<?php

namespace App\Models\Emdad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categories extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [ 'name_en', 'name_ar','status','parent_id','isleaf','profile_id','reason'];
    public function Products()
    {
        return $this->hasMany(Prodcuts::class);
    }
}
