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
        function camelCaseKeys($array)
{
    foreach($array as $key => $value) {
        if (is_array($value)) {
            foreach($value as $x => $y) {
                $camelCase = str_replace(' ', '', ucwords(str_replace('_', ' ', $x)));
                $camelCase[0] = strtolower($camelCase[0]);
                $array[$key][$camelCase] = $y;
                unset($array[$key][$x]);
            }
        } else {
            $keyCamelCase = str_replace(' ', '', ucwords(str_replace('_', ' ', $key)));
            $keyCamelCase[0] = strtolower($keyCamelCase[0]);
            $array[$keyCamelCase] = $value;
            unset($array[$key]);
        }
    }

    return $array;
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
dd(camelCaseKeys($defaultSelect));
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
