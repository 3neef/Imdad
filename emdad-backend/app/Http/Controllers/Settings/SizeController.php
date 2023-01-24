<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\AddSizeRequest;
use App\Http\Services\Settings\SizeService;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    public SizeService $sizeServices;


    public function __construct(SizeService $sizeServices) {
        $this->sizeServices = $sizeServices;
    }


    public function store(AddSizeRequest $request)
    {
        $size = $this->sizeServices->store($request);
        if($size){
            return response()->json(["statusCode" => "000",'message' => 'created successfully', ], 200);
        }
        return response()->json([ "statusCode" => "264",'success' => false, 'message' => "User Dosn't belong to any profile "], 200);
    }
    

    public function index(Request $request)
    {
        $size = $this->sizeServices->show($request);
        if($size){
            return response()->json(["statusCode" => "000",'data' => $size,
            ], 200);
        }
        return response()->json([
            "statusCode" => "264",'success' => false, 'message' => "User Dosn't belong to any profile "], 200);
    }

}
