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
        'firstname', 'lastname', 'name', 'email', 'password', 'phone', 'status', 
        'avatar', 'otp', 'otp_expires_at', 'forget_pass','otp_used', 'mobile'
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

    public function roleInCompany(){
        return $this->belongsToMany(Role::class,'roles_users_company_info','users_id','roles_id');
    }

    public function exists($roleId,$companyId){
        return $this->belongsToMany(Role::class,'roles_users_company_info','users_id','roles_id')
        ->wherePivot('roles_id',$roleId)
        ->wherePivot('company_info_id',$companyId)
        ->first();
    }

}
