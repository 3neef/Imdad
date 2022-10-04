<?php

namespace App\Models\UM;

use App\Models\UM\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;
    protected $tabel = 'roles';
    protected $guarded = ['id'];
    protected $fillable = array('name');

    public function permissions()
    {
        return RolePermission::where("role_id",$this->id)->value("json");
    }

    public function givePermissionTo(RolePermission $permission)
    {
        return $this->permissions()->save($permission);
    }
    /**
     * Determine if the user may perform the given permission.
     *
     * @param  Permission $permission
     * @return boolean
     */
    public function hasPermission(RolePermission $permission, User $user)
    {
        return $this->hasRole($permission->roles);
    }
    /**
     * Determine if the role has the given permission.
     *
     * @param  mixed $permission
     * @return boolean
     */
    public function inRole($permission)
    {
        if (is_string($permission)) {
            return $this->permissions->contains('name', $permission);
        }
        return !!$permission->intersect($this->permissions)->count();
    }
}
