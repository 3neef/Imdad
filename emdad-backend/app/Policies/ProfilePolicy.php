<?php

namespace App\Policies;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProfilePolicy
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
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Profile $profile)
    {
        return $this->checkPermission($user,$type1="BMC4" ,$type2="SMC4");
        
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $this->checkPermission($user,$type1="BMC1" ,$type2="SMC1");
        
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Profile $profile)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Profile $profile)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Profile $profile)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Profile $profile)
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
