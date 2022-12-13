<?php

namespace App\Models\UM;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = ['name', 'label','category','description'];

}
