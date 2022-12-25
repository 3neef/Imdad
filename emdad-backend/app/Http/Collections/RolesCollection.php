<?php


namespace App\Http\Collections;

use App\Models\UM\Role;
use Illuminate\Support\Str;

use Spatie\QueryBuilder\QueryBuilder;

class RolesCollection
{
    public static function collection($request)
    {

        $defaultSort = '-created_at';

        $defaultSelect = ['id','name','type','permissions_list','for_reg'
        ];
    function convertKeysToCamelCase($apiResponseArray) {
            $keys = array_map(function ($i) {
                $parts = explode('_', $i);
                return array_shift($parts). implode('', array_map('ucfirst', $parts));
            }, array_keys($apiResponseArray));
        
            return array_combine($keys, $apiResponseArray);
        }
        // $lorem=(Str::camel('permissions_list'));
        // dd($lorem);

        $allowedFilters = [
            'id',
            'name',
            'type',
            'for_reg',
        ];

        $allowedSorts = [
            'updated_at',
            'created_at',
        ];


// dd(convertKeysToCamelCase($defaultSelect));
        $perPage =  $request->pageSize ?? 100;

        return QueryBuilder::for(Role::class)
            ->select(($defaultSelect))
            ->allowedFilters($allowedFilters)
            ->allowedSorts($allowedSorts)
            ->defaultSort($defaultSort)
            ->paginate($perPage);
    }
}
