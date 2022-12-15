<?php


namespace App\Http\Collections;

use App\Models\Emdad\Product;
use Spatie\QueryBuilder\QueryBuilder;

class ProductsCollection
{
    public static function collection()
    {

        $defaultSort = '-created_at';

        $defaultSelect = [
            'name', 'measruing_unit', 'category_id', 'price', 'profile_id', 'image'
        ];


        $allowedFilters = [
            'name', 'measruing_unit', 'category_id', 'price', 'profile_id', 'image'
        ];

        $allowedSorts = [
            'updated_at',
            'created_at',
        ];

        $allowedIncludes = [
            'unit_measruing', 'category'
        ];

        $perPage =  100;

        return QueryBuilder::for(Product::class)
            ->select($defaultSelect)
            ->allowedFilters($allowedFilters)
            ->allowedSorts($allowedSorts)
            ->allowedIncludes($allowedIncludes)
            ->defaultSort($defaultSort)
            ->paginate($perPage);
    }
}
