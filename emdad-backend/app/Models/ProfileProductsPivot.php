<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileProductsPivot extends Model
{
    use HasFactory;
    protected $table = 'profile_products_pivots';
    protected $fillable = ['profile_id','product_id','status'];
}
