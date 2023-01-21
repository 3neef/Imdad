<?php

namespace App\Policies;

// use App\Models\Emdad\Categories;

use App\Models\Emdad\Category;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\DB;

class CategoryPolicy
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
     * @param  \App\Models\Category  $categories
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Category $category)
    {
       return $this->checkPermission($user, $type1 = "BMCT1", $type2 = "SMCT1");
        
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
       return $this->checkPermission($user, $type1 = "BMCT2", $type2 = "SMCT2");
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Category $category)
    {
       return $this->checkPermission($user, $type1 = "BMCT2", $type2 = "SMCT2");
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Category $category)
    {
        
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Category $category)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Category $category)
    {
        //
    }

    public function checkPermission($user, $type1,$type2)
    {
        // dd($user);
        if ($user->currentProfile()->type == "Buyer" || $user->currentProfile()->type == "Supplier") {
            $permissonis = DB::table('profile_role_user')->where('user_id', $user->id)->where('profile_id', $user->profile_id)->pluck('permissions')->first();
            if ($permissonis!= null) {
                $labels = json_decode($permissonis);
                foreach ($labels as $label) {
                    if ($label == $type1||$label==$type2) {
                        return true;
                    }
                }
            }
        }
    }
}
