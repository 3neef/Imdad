<?php

namespace App\Policies;

use App\Models\Accounts\Truck;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\DB;

class TruckPolicy
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
        // return $this->checkPermission($user,$type1="SMFLT4"); 
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Truck  $truck
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user)
    {
        return $this->checkPermission($user,$type1="SMFLT4");
        
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
      return  $this->checkPermission($user,$type1="SMFLT1");
        
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Truck  $truck
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user)
    {
      return  $this->checkPermission($user,$type1="SMFLT2");
        
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Truck  $truck
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user)
    {
      return  $this->checkPermission($user,$type1="SMFLT3");
        
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Truck  $truck
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user)
    {
    //   return  $this->checkPermission($user,$type1="SMFL47");
        
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Truck  $truck
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Truck $truck)
    {
        //
    }
    public function checkPermission($user, $type1)
    {
        if ($user->currentProfile()->type == "Buyer" || $user->currentProfile()->type == "Supplier") {
            $permissonis = DB::table('profile_role_user')->where('user_id', $user->id)->where('profile_id', $user->profile_id)->pluck('permissions')->first();
            if ($permissonis!= null) {
                $labels = json_decode($permissonis);
                foreach ($labels as $label) {
                    if ($label == $type1) {
                        return true;
                    }
                }
            }
        }
    }
}
