<?php

namespace App\Http\Services\AccountServices;

use App\Http\Collections\WarehouseCollection;
use App\Http\Resources\AccountResourses\warehouses\WarehouseResponse;
use App\Models\Accounts\Warehouse;
use App\Models\User;
use App\Models\UserWarehousePivot;
use App\Models\WarehouseType;
use Exception;
use Illuminate\Support\Facades\DB;

class WarehouseTypeService
{
    public function index($request){
        return WarehouseType::all();
    }

    public static function store($request){
        $warehouse_type = WarehouseType::create([
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
        ]);

        return $warehouse_type;
    }

    public static function update($request, $id){
        $warehouse_type = WarehouseType::find($id);
        if($warehouse_type != null){
            $warehouse_type->update([
                'name_en' => $request->name_en ?? $warehouse_type->name_en,
                'name_ar' => $request->name_ar ?? $warehouse_type->name_ar,
            ]);
        }else{
            $warehouse_type = null;
        }
        return $warehouse_type;
    }

    public static function delete($id){
        $warehouse_type = WarehouseType::find($id)->delete();

        return $warehouse_type;
    }

    public static function restore($id){
        $warehouse_type = WarehouseType::withTrashed()->findorfail($id)->restore();

        return $warehouse_type;
    }

  
}