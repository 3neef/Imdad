<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\AddBrandRequest;
use App\Http\Services\Settings\BrandService;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public BrandService $prandServices;


    public function __construct(BrandService $prandServices) {
        $this->prandServices = $prandServices;
    }


    public function store(AddBrandRequest $request)
    {
        $brand = $this->prandServices->store($request);
        if($brand){
            return response()->json(["statusCode" => "000",'message' => 'created successfully', ], 200);
        }
        return response()->json([ "statusCode" => "264",'success' => false, 'message' => "User Dosn't belong to any profile "], 200);
    }
    

    public function index(Request $request)
    {
        $brand = $this->prandServices->show($request);
        if($brand){
            return response()->json(["statusCode" => "000",'data' => $brand,
            ], 200);
        }
        return response()->json([
            "statusCode" => "264",'success' => false, 'message' => "User Dosn't belong to any profile "], 200);
    }




}
