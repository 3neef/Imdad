<?php


namespace App\Http\Collections;

use App\Models\Accounts\CompanyInfo;
use App\Models\Driver;
use Spatie\QueryBuilder\QueryBuilder;

class DriverCollection
{
    public static function collection()
    {

        $defaultSort = '-created_at';

        $defaultSelect = [
            'name_ar',
            'name_en',
            'age',
            'phone',
            'nationality'
        ];


        $allowedFilters = [
            'name_ar',
            'name_en',
            'age',
            'phone',
            'nationality'
        ];

        $allowedSorts = [
            'name_ar',
            'name_en',
        ];

        // $allowedIncludes = [
        //     'users',
        //     'departments',
        // ];

        $perPage =  100;

        return QueryBuilder::for(Profile::class)
            ->select($defaultSelect)
            ->allowedFilters($allowedFilters)
            ->allowedSorts($allowedSorts)
            // ->allowedIncludes($allowedIncludes)
            ->defaultSort($defaultSort)
            ->paginate($perPage);
    }
}