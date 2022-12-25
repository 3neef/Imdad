<?php


namespace App\Http\Collections;

use App\Models\Accounts\Warehouse;
use Spatie\QueryBuilder\QueryBuilder;

class WarehouseCollection
{
    public static function collection($request)
    {

        $defaultSort = '-created_at';

        $defaultSelect = [
            'addressName',
            'profileId',
            'addressContactPhone',
            'latitude',
            'longitude',
            'addressContactName',
            'addressType',
            'gateType',
            'confirmBy',
            'createdBy'
        ];


        $allowedFilters = [
            'addressName','addressContactPhone', 'addressType', 'gateType', 'created_by','confirm_by',
        ];

        $allowedSorts = [
            'updated_at',
            'created_at',
        ];

        $allowedIncludes = [
            'truckImage'
        ];

        $perPage =  $request->pageSize ?? 100;

        return QueryBuilder::for(Warehouse::class)
            ->select($defaultSelect)
            ->allowedFilters($allowedFilters)
            ->allowedSorts($allowedSorts)
            ->allowedIncludes($allowedIncludes)
            ->defaultSort($defaultSort)
            ->paginate($perPage);
    }
}
