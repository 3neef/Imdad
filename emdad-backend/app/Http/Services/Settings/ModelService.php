<?php

namespace App\Http\Services\Settings;

use App\Models\Settings\VechileModel;
use App\Models\Settings\VehicleBrand;

class ModelService
{


    public  static function store($request)
    {
        $brand = VechileModel::create([
            'year' => $request->year,
           
        ]);
        return $brand;
    }


    public  static function show($request)
    {
        $brand = VechileModel::all();
        return $brand;
    }
}
