<?php


namespace App\Http\Collections;

use App\Models\Emdad\Product;
use Spatie\QueryBuilder\QueryBuilder;

class ProductsCollection
{
    public static function collection($request)
    {

        $defaultSort = '-created_at';


        $allowedFilters = [
            'name_ar', 'name_en', 'measruing_unit', 'category_id', 'price', 'description_en', 'description_ar', 'profile_id',
        ];

        $allowedSorts = [
            'updated_at',
            'created_at',
        ];

        $allowedIncludes = [
            'unit_measruing', 'category'
        ];

        $perPage =  $request->pageSize ?? 100;

        return QueryBuilder::for(Product::class)
            ->allowedFilters($allowedFilters)
            ->allowedSorts($allowedSorts)
            ->allowedIncludes($allowedIncludes)
            ->with('media')
            ->defaultSort($defaultSort)
            ->paginate($perPage);
    }
}
