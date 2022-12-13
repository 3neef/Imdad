<?php

namespace App\Models\UM;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoleUserProfile extends Pivot
{
    use SoftDeletes;
    protected $fillable = ['permissions'];

    protected $table = 'roles_users_profiles';
    public function users()
    {
        return $this->belongsToMany(User::class, 'roles_users_profiles', 'users_id')->withTimestamps()->withPivot("status");
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'roles_users_profiles', 'roles_id')->withTimestamps()->withPivot("status");
    }

    public function profiles()
    {
        return $this->belongsToMany(Profile::class, 'roles_users_profiles', 'profiles_id')->withTimestamps()->withPivot("status");
    }
}
