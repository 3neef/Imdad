<?php

namespace App\Models\Accounts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Warehouse extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "warehouses";
    protected $fillable = [
        'address_name',
        'profile_id',
        'address_contact_phone',
        'latitude',
        'longitude',
        'address_contact_name',
        'address_type',
        'gate_type',
        'otp_receiver',
        'otp_expires_at',
        'otp_verfied',
        'confirm_by',
        'created_by'
    ];
}
