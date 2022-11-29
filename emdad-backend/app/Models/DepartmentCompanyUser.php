<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class DepartmentCompanyUser extends Pivot
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
