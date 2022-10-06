<?php

namespace App\Models\Accounts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyInfo extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'name', 'company_id', 'company_type', 'company_vat_id', 'contact_name', 'contact_phone', 'contact_email'
    ];
}
