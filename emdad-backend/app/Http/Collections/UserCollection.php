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
//         function convertKeysToCamelCase($apiResponseArray)
// {
//     $arr = [];
//     foreach ($apiResponseArray as $key => $value) {
//         if (preg_match('/_/', $key)) {
//             preg_match('/[^_]*/', $key, $m);
//             preg_match('/(_)([a-zA-Z]*)/', $key, $v);
//             $key = $m[0] . ucfirst($v[2]);
//         }


//         if (is_array($value))
//             $value = $this->convertKeysToCamelCase($value);

//         $arr[$key] = $value;
//     }
//     return $arr;
// }

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
// dd(convertKeysToCamelCase($defaultSelect));
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
