<?php


namespace App\Http\Collections;

use App\Models\Accounts\CompanyInfo;
use App\Models\Profile;
use Spatie\QueryBuilder\QueryBuilder;

class DriverCollection
{
    public static function collection()
    {

        $defaultSort = '-created_at';

        $defaultSelect = [
            'created_by',
            'name_ar',
            'name_en',
            'swift',
            'iban',
            'type',
            'bank',
            'vat_number',
            'cr_number',
            'cr_expire_data',
            'subs_id',
            'subscription_details',
            'active'
        ];


        $allowedFilters = [
            'id',
            'name_ar',
            'name_en',
            'cr_number',
            'vat_number',
            'iban',
            'updated_at',
            'created_at',
        ];

        $allowedSorts = [
            'updated_at',
            'created_at',
        ];

        $allowedIncludes = [
            'users',
            'departments',
        ];

        $perPage =  100;

        return QueryBuilder::for(Profile::class)
            ->select($defaultSelect)
            ->allowedFilters($allowedFilters)
            ->allowedSorts($allowedSorts)
            ->allowedIncludes($allowedIncludes)
            ->defaultSort($defaultSort)
            ->paginate($perPage);
    }
}