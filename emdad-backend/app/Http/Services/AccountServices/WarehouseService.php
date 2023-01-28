<?php

namespace App\Http\Services\AccountServices;

use App\Http\Collections\WarehouseCollection;
use App\Http\Resources\AccountResourses\warehouses\WarehouseResponse;
use App\Models\Accounts\Warehouse;
use App\Models\User;
use App\Models\UserWarehousePivot;
use Exception;
use Illuminate\Support\Facades\DB;

class WarehouseService
{


    public function index($request)
    {
        return WarehouseResponse::collection(WarehouseCollection::collection($request));
    }

    public static function store($request)
    {
        $packageLimit = new PackageConstraint;
        $value = Warehouse::where('profile_id', auth()->user()->profile_id)->count();
        $Limit = $packageLimit->packageLimitExceed("Warehouse", $value);
        if ($Limit == false) {
            return response()->json([
                "statusCode" => "361",
                'success' => false,
                'message' => "You have exceeded the allowed number of Warehouse to create it"
            ], 200);
        }
        return DB::transaction(function () use ($request) {
            $warehouse = Warehouse::create([
                'profile_id' => auth()->user()->profile_id,
                'address_name' => $request->warehouseName,
                'address_contact_phone' => $request->receiverPhone ?? null,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'address_contact_name' => $request->receiverName ?? null,
                'address_type' => $request->warehouseType,
                'gate_type' => $request->gateType ?? "",
                'created_by' => auth()->id(),
                'otp_expires_at' => now()->addMinutes(3),
                'manager_id' => $request->managerId ?? auth()->id(),
                'otp_receiver' => strval(rand(1000, 9999)),
            ]);
            if (isset($request['userList'])) {
                foreach ($request['userList'] as $user_id) {
                    try {
                        $warehouse->users()->attach($warehouse->id, ['user_id' => $user_id ?? auth()->user->id]);
                    } catch (Exception $ex) {
                    }
                }
            }
            return $warehouse;
        });
    }



    public static function update($request, $id)
    {

        $warehouse = Warehouse::where('id', $id)->first();
        if ($warehouse != null) {
            $warehouse->update([
                'address_name' => $request->warehouseName ?? $warehouse->address_name,
                "address_type" => $request->warehouseType ?? $warehouse->address_type,
                "gate_type" => $request->gateType ?? $warehouse->gate_type,
                "address_contact_name" => $request->receiverName ?? $warehouse->address_contact_name,
                "address_contact_phone" => $request->receiverPhone ?? $warehouse->address_contact_phone,
                "latitude" => $request->latitude ?? $warehouse->latitude,
                "longitude" => $request->longitude ?? $warehouse->longitude,

            ]);
            return $warehouse;
        }

    }
    public static function show($id)
    {
        $warehouses = Warehouse::where('id', $id)->first();
        return $warehouses;
    }

    public function showByUserId($id)
    {
        $userId = User::find($id)->id;
        $warehouses = Warehouse::where('confirm_by', $userId)->first();
        return response()->json(["statusCode" => '000', 'data' => new WarehouseResponse($warehouses)], 200);
    }
    public function showByProfileId($id)
    {
        $warehouses = Warehouse::where('profile_id', $id);
        return response()->json(["statusCode" => '000', 'data' => WarehouseResponse::collection($warehouses)], 200);
    }


    public function delete($id)
    {
        $warehouses = Warehouse::find($id)->first();
        if ($warehouses != null) { // replace false by checking user permission
            $warehouses->forceDelete();
            return $warehouses;
        }
    }



    // public function restore($id)
    // {
    //     $restore = Warehouse::where('id', $id)->withTrashed()->restore();
    //     if ($restore) {
    //         return response()->json(["statusCode" => '000', 'message' => 'restored successfully'], 200);
    //     }
    //     return response()->json(["statusCode" => '999', 'error' => 'system error'], 500);
    // }

    public static function verfied($id)
    {
        $warehouses = Warehouse::where('id', $id)->first();
        $verfied = $warehouses->update(['confirm_by' => auth()->id(), 'otp_receiver' => null, 'otp_expires_at' => null, 'otp_verfied' => true, "status" => "Active"]);
        if ($verfied) {
            return true;
        }
        
    }


    public static  function assignWarehouseToUser($request)
    {
        $user = User::find($request->userId);
        $warehouse = Warehouse::find($request->warehouseId);
        if ($user != null && $warehouse != null) {
             $warehouse->users()->attach($user);
            return $warehouse;
        }
       
    }

    public static  function unAssignWarehouseFromUser($request)
    {
        $user = User::find($request->userId);
        $warehouse = Warehouse::find($request->warehouseId);
        if ($user != null && $warehouse != null) {
            $unAssign = $warehouse->users()->detach($user);
            return $unAssign;
        }
    }
}