<?php


namespace App\Http\Collections;

use App\Models\Accounts\CompanyInfo;
use App\Models\Driver;
use App\Models\UM\RoleUserProfile;
use Spatie\QueryBuilder\QueryBuilder;

class UsersProfilesCollection
{
    public static function collection()
    {

        $defaultSort = '-created_at';

        $defaultSelect = [
            'id',
            'role_id',
            'user_id',
            'profile_id',
            'permissions',
            'status',
            'updated_at',
            'created_at',
        ];


        $allowedFilters = [
            'id',
            'role_id',
            'user_id',
            'profile_id',
            'updated_at',
            'created_at',
        ];

        $allowedSorts = [
            'updated_at',
            'created_at',
        ];

        $allowedIncludes = [
            'users',
            'roles',
            'profiles',
        ];

        $perPage =  100;

        return QueryBuilder::for(RoleUserProfile::class)
            ->select($defaultSelect)
            ->allowedFilters($allowedFilters)
            ->allowedSorts($allowedSorts)
            ->allowedIncludes($allowedIncludes)
            ->defaultSort($defaultSort)
            ->paginate($perPage);
    }
}
