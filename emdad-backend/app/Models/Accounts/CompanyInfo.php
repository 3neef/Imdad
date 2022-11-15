<?php

namespace App\Models\Accounts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyInfo extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'company_info';
    protected $fillable = [
        'first_name', 'last_name', 'role_id', 'person_id', 'id_type', 'company_type',
        'contact_phone', 'contact_email', 'subscription_details',
        'cr_expire_data', 'subs_id', 'subscription_details', 'is_validated'
    ];
}
