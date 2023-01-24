<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\AddModelRequest;
use App\Http\Services\Settings\Modelervice;
use App\Http\Services\Settings\ModelService;
use Illuminate\Http\Request;

class ModelController extends Controller
{
    public ModelService $modelServices;


    public function __construct(ModelService $modelServices) {
        $this->modelServices = $modelServices;
    }


    public function store(AddModelRequest $request)
    {
        $model = $this->modelServices->store($request);
        if($model){
            return response()->json(["statusCode" => "000",'message' => 'created successfully', ], 200);
        }
        return response()->json([ "statusCode" => "264",'success' => false, 'message' => "User Dosn't belong to any profile "], 200);
    }
    

    public function index(Request $request)
    {
        $model = $this->modelServices->show($request);
        if($model){
            return response()->json(["statusCode" => "000",'data' => $model,
            ], 200);
        }
        return response()->json([
            "statusCode" => "264",'success' => false, 'message' => "User Dosn't belong to any profile "], 200);
    }
}
