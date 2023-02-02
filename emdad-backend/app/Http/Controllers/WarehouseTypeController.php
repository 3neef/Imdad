<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountRequests\Location\CreateWarehouseTypeRequest;
use App\Http\Requests\AccountRequests\Location\UpdateWarehouseTypeRequest;
use App\Http\Services\AccountServices\WarehouseTypeService;
use Illuminate\Http\Request;

class WarehouseTypeController extends Controller
{
    protected WarehouseTypeService $warehouseTypeService;
    public function __construct(WarehouseTypeService $warehouseTypeService)
    {
        $this->warehouseTypeService = $warehouseTypeService;
    }
   
    public function index(Request $request){
        return $this->warehouseTypeService->index($request);
    }
    
    public function store(CreateWarehouseTypeRequest $request){
        $output = $this->warehouseTypeService->store($request);

        return response()->json([ 'statusCode'=> $output['statusCode'], "message"=>$output['message'], "success"=> $output['success'], "data"=> $output['data'] ],200);
    }
    
    public function update(UpdateWarehouseTypeRequest $request, $id){
        $output = $this->warehouseTypeService->update($request, $id);

        return response()->json([ 'statusCode'=> $output['statusCode'], "message"=>$output['message'], "success"=> $output['success'], "data"=> $output['data'] ],200);
    }
    
    public function destroy($id){
        $output = $this->warehouseTypeService->delete($id);

        return response()->json([ 'statusCode'=> $output['statusCode'], "message"=>$output['message'], "success"=> $output['success']],200);

    }
    
    public function restore($id){
        $output = $this->warehouseTypeService->restore($id);

        return response()->json([ 'statusCode'=> $output['statusCode'], "message"=>$output['message'], "success"=> $output['success']],200);

    }
}
