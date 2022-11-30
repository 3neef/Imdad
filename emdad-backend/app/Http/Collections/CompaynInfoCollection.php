<?php


namespace App\Http\Collections;

use App\Models\Accounts\CompanyInfo;
use Spatie\QueryBuilder\QueryBuilder;

class CompaynInfoCollection
{
    public static function collection()
    {

        $defaultSort = '-created_at';

        $defaultSelect = [
            'id',
            'company_type',
            'contact_phone',
            'contact_email',
            'subscription_details',
            'company_name',
            'cr_expire_data',
            'updated_at',
            'created_at',
        ];


        $allowedFilters = [
            'id',
            'company_type',
            'contact_phone',
            'contact_email',
            'company_name',
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

        return QueryBuilder::for(CompanyInfo::class)
            ->select($defaultSelect)
            ->allowedFilters($allowedFilters)
            ->allowedSorts($allowedSorts)
            ->allowedIncludes($allowedIncludes)
            ->defaultSort($defaultSort)
            ->paginate($perPage);
    }
}
