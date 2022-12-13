<?php

namespace App\Models\UM;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;
    protected $tabel = 'roles';
    protected $guarded = ['id'];
    protected $fillable = ['name','type','permissions_list','for_reg'];


    // public function givePermissionTo(RolePermission $permission)
    // {
    //     return $this->permissions()->save($permission);
    // }
    /**
     * Determine if the user may perform the given permission.
     *
     * @param  Permission $permission
     * @return boolean
     */
    // public function hasPermission(RolePermission $permission)
    // {
    //     return $this->hasRole($permission->roles);
    // }
    /**
     * Determine if the role has the given permission.
     *
     * @param  mixed $permission
     * @return boolean
     */

}
