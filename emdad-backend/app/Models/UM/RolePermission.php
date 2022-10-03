<?php

namespace App\Models\UM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RolePermission extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'role_permissions';
    protected $guarded = ['id'];
    protected $fillable = array('role_id','json');

    public function roles()
    {
        return $this->belongsTo(Role::class);
    }
    /**
     * Determine if the permission belongs to the role.
     *
     * @param  mixed $role
     * @return boolean
     */
    public function inRole($role)
    {
        if (is_string($role)) {
            return $this->roles->contains('name', $role);
        }
        return !!$role->intersect($this->roles)->count();
    }
}
