<?php

namespace App\Models\Accounts;

use App\Models\Department;
use App\Models\User;
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

    public function users()
    {
        return $this->belongsToMany(
            User::class, 'company_info_department_user'
        )->withPivot('department_id');
    }
    public function departments()
    {
        return $this->belongsToMany(
            Department::class, 'company_info_department_user'
        )->withPivot('user_id');
    }
}
