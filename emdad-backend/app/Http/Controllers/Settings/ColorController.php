<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\AddColorRequest;
use App\Http\Services\Settings\ColorService;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public ColorService $colorServices;


    public function __construct(ColorService $colorServices) {
        $this->colorServices = $colorServices;
    }


    public function store(AddColorRequest $request)
    {
        $color = $this->colorServices->store($request);
        if($color){
            return response()->json(["statusCode" => "000",'message' => 'created successfully', ], 200);
        }
        return response()->json([ "statusCode" => "264",'success' => false, 'message' => "Color Canot create "], 200);
    }
    

    public function index(Request $request)
    {
        $color = $this->colorServices->show($request);
        if($color){
            return response()->json(["statusCode" => "000",'data' => $color,
            ], 200);
        }
        return response()->json([
            "statusCode" => "264",'success' => false, 'message' => "Color Canot create  "], 200);
    }
}
