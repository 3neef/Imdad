<?php

namespace App\Models\UM;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoleUserProfile extends Pivot
{
    use SoftDeletes;
    protected $fillable = ['permissions','status','is_learning','user_id','role_id','profile_id','manager_user_Id'];

    protected $table = 'role_user_profile';

    public function users()
    {
        return $this->belongsToMany(User::class, 'role_user_profile', 'user_id')->withTimestamps()->withPivot("status");
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user_profile', 'role_id')->withTimestamps()->withPivot("status");
    }

    public function profiles()
    {
        return $this->belongsToMany(Profile::class, 'role_user_profile', 'profile_id')->withTimestamps()->withPivot("status");
    }
}
