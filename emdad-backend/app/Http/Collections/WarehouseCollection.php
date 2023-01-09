<?php


namespace App\Http\Collections;

use App\Http\CustomFliters\DefaultWarehousesFilter;
use App\Models\Accounts\Warehouse;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class WarehouseCollection
{
    public static function collection($request)
    {

        $defaultSort = '-created_at';

        $defaultSelect = [
            'id',
            'address_name',
            'profile_id',
            'address_contact_phone',
            'latitude',
            'address_contact_name',
            'address_type',
            'longitude',
            'gate_type',
            'confirm_by',
            'created_by',
            'created_at',
            "manager_id"
        ];


        $allowedFilters = [
            'address_name', 'address_contact_phone', 'address_type', 'gate_type', 'created_by',
            'confirm_by',
            AllowedFilter::custom('default', new DefaultWarehousesFilter)->default(auth()->user()),

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
            ->allowedFilters($allowedFilters)
            ->allowedSorts($allowedSorts)
            ->allowedIncludes($allowedIncludes)
            
            ->paginate($perPage);
    }
}
