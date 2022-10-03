<?php

namespace App\Models\UM;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $guarded = ['id'];
    protected $fillable = array('name', 'label', 'description');


}
