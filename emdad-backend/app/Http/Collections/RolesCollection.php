<?php


namespace App\Http\Collections;

use App\Models\UM\Role;
use Spatie\QueryBuilder\QueryBuilder;

class RolesCollection
{
    public static function collection($request)
    {

        $defaultSort = '-created_at';

        $defaultSelect = [
            'id',
            'name', 
            'type', 
            'permissions_list', 
            'for_reg'
        ];


        $allowedFilters = [
            'name', 'type', 'for_reg',
        ];

        $allowedSorts = [
            'updated_at',
            'created_at',
        ];



        $perPage =  $request->pageSize ?? 100;

        return QueryBuilder::for(Role::class)
            ->select($defaultSelect)
            ->allowedFilters($allowedFilters)
            ->allowedSorts($allowedSorts)
            ->defaultSort($defaultSort)
            ->paginate($perPage);
    }
}
