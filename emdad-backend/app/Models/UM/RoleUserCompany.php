<?php

namespace App\Models\UM;

use App\Models\Accounts\CompanyInfo;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoleUserCompany extends Pivot
{
    use SoftDeletes;
    protected $table ='roles_users_company_info';
    public function users(){
        return $this->belongsToMany(User::class,'roles_users_company_info','users_id')->withTimestamps()->withPivot("status");
    }
    
    public function roles(){
        return $this->belongsToMany(Role::class,'roles_users_company_info','roles_id')->withTimestamps()->withPivot("status");
    }
    
    public function companies(){
        return $this->belongsToMany(CompanyInfo::class,'roles_users_company_info','company_info_id')->withTimestamps()->withPivot("status");
    }
}
