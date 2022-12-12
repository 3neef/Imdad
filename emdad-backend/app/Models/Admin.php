<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Admin extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_title',
        'name_ar',
        'name_en',
        'password'
    ];

    public function user () {
        return $this->morphOne(User::class, 'userable');
    }
}
