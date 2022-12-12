<?php

namespace App\Models;

use App\Models\Accounts\CompanyInfo;
use App\Models\UM\Role;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Laravel\Sanctum\HasApiTokens as SanctumHasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use SanctumHasApiTokens, Notifiable, SoftDeletes;
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'identity_type', 'email', 'password', 'identity_number',
        'is_verified', 'profile_id', 'avatar', 'otp', 'is_super_admin',
        'otp_expires_at', 'mobile',  'expiry_date', 'lang', 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'role_id' => 'integer',
        'statut' => 'integer',
    ];

    public function oauthAccessToken()
    {
        return $this->hasMany('\App\Models\UM\OauthAccessToken');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    // public function company()
    // {
    //     return $this->belongsToMany(CompanyInfo::class);
    // }

    // public function currentCompany()
    // {
    //     return CompanyInfo::where("id",$this->default_company)->select(["company_name",'is_validated','subscription_details','cr_expire_data','company_type','company_id'])->first();
    // }

    // public function assignRole(Role $role)
    // {
    //     return $this->roles()->save($role);
    // }

    // public function hasRole($role)
    // {
    //     if (is_string($role)) {
    //         return $this->roles->contains('name', $role);
    //     }
    //     return !!$role->intersect($this->roles)->count();
    // }

    // public function roleInCompany()
    // {
    //     return $this->belongsToMany(Role::class, 'roles_users_company_info', 'users_id', 'roles_id')
    //         ->withPivot('company_info_id')
    //         ->withTimestamps();
    // }

    // public function exists($roleId, $companyId)
    // {
    //     return $this->belongsToMany(Role::class, 'roles_users_company_info', 'users_id', 'roles_id')
    //         ->wherePivot('roles_id', $roleId)
    //         ->wherePivot('company_info_id', $companyId)
    //         ->first();
    // }

    // public function getRoleOfUserByCompanyId()
    // {
    //     return $this->belongsToMany(Role::class, 'roles_users_company_info', 'users_id', 'roles_id')
    //         ->wherePivot('company_info_id', $this->default_company)
    //         ->first();
    // }

    // public function compnies()
    // {
    //     return $this->belongsToMany(
    //         CompanyInfo::class,
    //         'company_info_department_user'
    //     )->withPivot('department_id')
    //         ->withTimestamps();;
    // }
    // public function departments()
    // {
    //     return $this->belongsToMany(
    //         Department::class,
    //         'company_info_department_user'
    //     )->withPivot('company_info_id')
    //         ->withTimestamps();;
    // }

    public function userable()
    {
        return $this->morphTo();
    }
}
