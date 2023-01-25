<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\AddBrandRequest;
use App\Http\Services\Settings\BrandService;
use App\Http\Services\Settings\DriverNationalityService;
use Illuminate\Http\Request;

class DriverNationalityController extends Controller
{
    public DriverNationalityService $driverNationalityServices;


    public function __construct(DriverNationalityService $driverNationalityServices) {
        $this->driverNationalityServices = $driverNationalityServices;
    }


    public function store(AddBrandRequest $request)
    {
        $nationality = $this->driverNationalityServices->store($request);
        if($nationality){
            return response()->json(["statusCode" => "000",'message' => 'created successfully', ], 200);
        }
        return response()->json([ "statusCode" => "264",'success' => false, 'message' => "Brand Canot create "], 200);
    }
    

    public function index(Request $request)
    {
        $nationality = $this->driverNationalityServices->show($request);
        if($nationality){
            return response()->json(["statusCode" => "000",'data' => $nationality,
            ], 200);
        }
        return response()->json([
            "statusCode" => "264",'success' => false, 'message' => "Brand Canot create "], 200);
    }




}
