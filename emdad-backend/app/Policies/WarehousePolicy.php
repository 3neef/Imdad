<?php

namespace App\Policies;

use App\Models\Accounts\Warehouse;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\DB;

class WarehousePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Warehouse  $warehouse
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user)
    {
        return $this->checkPermission($user, $type1 = "BMW4", $type2 = "SMW4");
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $this->checkPermission($user, $type1 = "BMW1", $type2 = "SMW1");
        
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Warehouse  $warehouse
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user)
    {
        return $this->checkPermission($user, $type1 = "BMW2", $type2 = "SMW2");
        
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Warehouse  $warehouse
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user)
    {
        // return $this->checkPermission($user, $type1 = "BMW3", $type2 = "SMW3");
        
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Warehouse  $warehouse
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Warehouse $warehouse)
    {
        // return $this->checkPermission($user, $type1 = "BMW47", $type2 = "SMW47");
        
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Warehouse  $warehouse
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Warehouse $warehouse)
    {
        //
    }

    public function checkPermission($user, $type1,$type2)
    {
        if ($user->currentProfile()->type == "Buyer" || $user->currentProfile()->type == "Supplier") {
            $permissonis = DB::table('profile_role_user')->where('user_id', $user->id)->where('profile_id', $user->profile_id)->pluck('permissions')->first();
            if ($permissonis != null) {
                $labels = json_decode($permissonis);
                foreach ($labels as $label) {
                    if ($label == $type1 || $label == $type2) {
                        return true;
                    }
                }
            }
        }
    }
}
