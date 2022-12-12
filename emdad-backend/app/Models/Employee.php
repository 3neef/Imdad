<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable=['profile_id','first_name','last_name'];


    public function user() {
        return $this->morphOne(User::class, 'userable');
    }
}
