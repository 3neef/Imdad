<?php

namespace App\Models\Coupon;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    protected $table = 'coupons';
    protected $fillable = ['code', 'value', 'is_percentage',
    'start_date','end_date', 'allowed', 'used','user_id','company_id'
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
