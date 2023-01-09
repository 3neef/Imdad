<?php


namespace App\Http\CustomFliters;

use App\Models\User;
use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class DefaultUsersFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        if ($value) {
            if ($value->currentProfile()->type == "Buyer" || $value->currentProfile()->type == "Supplier") {
                //   return DB::table('users')->select('*')
                //     ->join('role_user_profile', 'role_user_profile.user_id', '=', 'users.id')->where('role_user_profile.profile_id', $value->profile_id);
                 $query->join('role_user_profile', 'role_user_profile.user_id', '=', 'users.id')->where('role_user_profile.profile_id', $value->profile_id);
            }
        }
    }
}
