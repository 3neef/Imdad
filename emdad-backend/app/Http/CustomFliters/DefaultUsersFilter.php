<?php


namespace App\Http\CustomFliters;

use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class DefaultUsersFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        if ($value) {
            if ($value->currentProfile()->type == "Buyer" || $value->currentProfile()->type == "Supplier") {
                 $query->join('role_user_profile', 'role_user_profile.user_id', '=', 'users.id')->where('role_user_profile.profile_id', $value->profile_id);
            }
        }
    }
}
