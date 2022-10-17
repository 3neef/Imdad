<?php

namespace App\Models\Accounts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyLocations extends Model
{
    use HasFactory;
    protected $fillable = [
        'address_name',
         'company_id', 
         'address_contact_phone', 
         'latitude_longitude',
         'address_contact_name',
          'address_type',
           'gate_type',
           'otp_receiver',
           'otp_expires_at',
           'confirm_by'];
}
