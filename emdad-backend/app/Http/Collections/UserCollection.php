<?php


namespace App\Http\Collections;

use Spatie\QueryBuilder\QueryBuilder;
use App\Models\User;
class UserCollection
{
    public static function collection ($request) {

        $defaultSort = '-created_at';

        $defaultSelect = [
            'id',
            'full_name',
            'mobile',
            'expiry_date',
            'identity_type',
            'identity_number',
            'profile_id',
            'email',
            'updated_at',
            'created_at',
        ];


        $allowedFilters = [
            'id',
            'full_name',
            'mobile',
            'expiry_date',
            'identity_type',
            'identity_number',
            'profile_id',
            'email',
            'updated_at',
            'created_at',
        ];

        $allowedSorts = [
            'updated_at',
            'created_at',
        ];

        $allowedIncludes = [
            'roles',
            'profiles',
        ];

        $perPage =  $request->pageSize ?? 100;

        return QueryBuilder::for(User::class)
            ->select($defaultSelect)
            ->allowedFilters($allowedFilters)
            ->allowedSorts($allowedSorts)
            ->allowedIncludes($allowedIncludes)
            ->defaultSort($defaultSort)
            ->paginate($perPage);
    }
}
