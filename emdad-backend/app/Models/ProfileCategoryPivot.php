<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProfileCategoryPivot extends Model
{
use SoftDeletes,HasFactory;
    protected $table = 'profile_category_pivots';
    protected $fillable = ['profile_id','category_id','status','updated_at','deleted_at'];

    


}
