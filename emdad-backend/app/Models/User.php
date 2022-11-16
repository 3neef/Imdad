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
        'identity_type',  'full_name', 'first_name', 'last_name', 'email', 'password',
        'status', 'is_verified', 'default_company', 'avatar', 'otp',
        'otp_expires_at', 'forget_pass', 'otp_used', 'mobile', 'identity', 'expiry_date', 'lang', 'used_basic_packeg'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'otp'
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

    public function company()
    {
        return $this->belongsToMany(CompanyInfo::class);
    }

    public function assignRole(Role $role)
    {
        return $this->roles()->save($role);
    }

    public function hasRole($role)
    {
        if (is_string($role)) {
            return $this->roles->contains('name', $role);
        }
        return !!$role->intersect($this->roles)->count();
    }

    public function roleInCompany()
    {
        return $this->belongsToMany(Role::class, 'roles_users_company_info', 'users_id', 'roles_id')
            ->withPivot('company_info_id')
            ->withTimestamps();
    }

    public function exists($roleId, $companyId)
    {
        return $this->belongsToMany(Role::class, 'roles_users_company_info', 'users_id', 'roles_id')
            ->wherePivot('roles_id', $roleId)
            ->wherePivot('company_info_id', $companyId)
            ->first();
    }

    public function getRoleOfUserByCompanyId($companyId)
    {
        return $this->belongsToMany(Role::class, 'roles_users_company_info', 'users_id', 'roles_id')
            ->wherePivot('company_info_id', $companyId)
            ->first();
    }

    public function compnies()
    {
        return $this->belongsToMany(
            CompanyInfo::class,
            'company_info_department_user'
        )->withPivot('department_id')
            ->withTimestamps();;
    }
    public function departments()
    {
        return $this->belongsToMany(
            Department::class,
            'company_info_department_user'
        )->withPivot('company_info_id')
            ->withTimestamps();;
    }
}
