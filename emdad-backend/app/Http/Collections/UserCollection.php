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
        function convertKeysToCamelCase($apiResponseArray) {
            $keys = array_map(function ($i) {
                $parts = explode('_', $i);
                return array_shift($parts). implode('', array_map('ucfirst', $parts));
            }, array_keys($apiResponseArray));
        
            return array_combine($keys, $apiResponseArray);
        }

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
dd(convertKeysToCamelCase($defaultSelect));
        $perPage =  $request->pageSize ?? 100;

        return QueryBuilder::for(User::class)
            ->select(convertKeysToCamelCase($defaultSelect))
            ->allowedFilters($allowedFilters)
            ->allowedSorts($allowedSorts)
            ->allowedIncludes($allowedIncludes)
            ->defaultSort($defaultSort)
            ->paginate($perPage);
    }
}
