<?php


namespace App\Http\Collections;

use App\Models\Emdad\Categories;
use Spatie\QueryBuilder\QueryBuilder;

class CategoryCollection
{
    public static function collection()
    {

        $defaultSort = '-created_at';

        $defaultSelect = [
            'name_en', 'name_ar','aproved','parent_id','isleaf'
        ];


        $allowedFilters = [
            'name_en', 'name_ar','aproved','parent_id','isleaf'
        ];

        $allowedSorts = [
            'updated_at',
            'created_at',
        ];

        $allowedIncludes = [
            'Products'
        ];

        $perPage =  100;

        return QueryBuilder::for(Categories::class)
            ->select($defaultSelect)
            ->allowedFilters($allowedFilters)
            ->allowedSorts($allowedSorts)
            ->allowedIncludes($allowedIncludes)
            ->defaultSort($defaultSort)
            ->paginate($perPage);
    }
}
