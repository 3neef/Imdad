<?php

namespace App\Http\Controllers;

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
    
    public function store(Request $request){
        return $this->warehouseTypeService->store($request);
    }
    
    public function update(Request $request, $id){
        return $this->warehouseTypeService->update($request, $id);
    }
    
    public function destroy($id){
        return $this->warehouseTypeService->delete($id);
    }
    
    public function restore($id){
        return $this->warehouseTypeService->restore($id);

    }
}
