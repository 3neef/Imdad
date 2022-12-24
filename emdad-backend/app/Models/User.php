<?php

namespace App\Models;

use App\Models\Accounts\CompanyInfo;
use App\Models\Accounts\SubscriptionPackages;
use App\Models\Accounts\Warehouse;
use App\Models\UM\Role;
use App\Models\UM\RoleUserProfile;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
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

        'full_name',
        'identity_type', 'email', 'password', 'identity_number',
        'is_verified', 'profile_id', 'avatar', 'otp', 'is_super_admin',
        'otp_expires_at', 'mobile',  'expiry_date', 'lang', 'manager_user_Id'
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

    public function currentProfile()
    {
        return Profile::where("id", $this->profile_id)->select(["name_ar", 'active', 'subscription_details', 'cr_expire_data', 'type', 'id'])->first();
    }

    public function userStatus()
    {
        return RoleUserProfile::where("profile_id", $this->profile_id)->where("user_id", $this->id)->first();
    }

    public function userRole(){
        return RoleUserProfile::where('role_id',$this->role_id)->where("user_id",$this->id)->first();
    }

    public function assignRole(Role $role)
    {
        return $this->roles()->save($role);
    }

    // public function hasRole($role)
    // {
    //     if (is_string($role)) {
    //         return $this->roles->contains('name', $role);
    //     }
    //     return !!$role->intersect($this->roles)->count();
    // }

    public function roleInProfile()
    {
        return $this->belongsToMany(Role::class, 'role_user_profile', 'user_id', 'role_id')
            ->withPivot('profile_id')
            ->withTimestamps();
    }

    public function exists($roleId, $profileId)
    {
        return $this->belongsToMany(Role::class, 'role_user_profile', 'user_id', 'role_id')
            ->wherePivot('role_id', $roleId)
            ->wherePivot('profile_id', $profileId)
            ->first();
    }



    public function warehouse()
    {
        return $this->belongsToMany(Warehouse::class, 'user_warehouse_pivots')->withPivot('warehouse_id')->get();
    }


    // public function getRoleOfUserByCompanyId()
    // {
    //     return $this->belongsToMany(Role::class, 'roles_users_company_info', 'users_id', 'roles_id')
    //         ->wherePivot('company_info_id', $this->default_company)
    //         ->first();
    // }


    public function profiles()
    {
        return $this->belongsToMany(
            Profile::class,
            'profile_department_user'
        )->withPivot('department_id')
            ->withTimestamps();
    }
    public function departments()
    {
        return $this->belongsToMany(
            Department::class,
            'profile_department_user'
        )->withPivot('profile_id')
            ->withTimestamps();
    }

    public function userable()
    {
        return $this->morphTo();
    }

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    public function oldOwner()
    {
        $count = SubscriptionPayment::where('user_id', auth()->id())->where('status', "Paid")->count();
        if ($count > 0) {
            return true;
        }
        return false;
    }


    public function checkUserRole($user_id, $profile_id = null)
    {

        if ($profile_id != null) {
            $count =  RoleUserProfile::where('user_id', $user_id)->where('profile_id', $profile_id)->count();
            if ($count > 0)
                return true;
        } else {
            $count =  RoleUserProfile::where('user_id', $user_id)->count();
            if ($count > 0)
                return true;
        }
        return false;
    }
}
