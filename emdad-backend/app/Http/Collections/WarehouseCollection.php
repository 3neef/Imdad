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
            'address_name',
            'profile_id',
            'address_contact_phone',
            'latitude',
            'longitude',
            'address_contact_name',
            'address_type',
            'gate_type',
            'confirm_by',
            'created_by'
        ];


        $allowedFilters = [
            'address_name','address_contact_phone', 'address_type', 'gate_type', 'created_by','confirm_by',
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
