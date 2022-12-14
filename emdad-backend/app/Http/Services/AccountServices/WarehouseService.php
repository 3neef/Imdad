<?php

namespace App\Http\Services\AccountServices;

use App\Http\Resources\AccountResourses\warehouses\WarehouseResponse;
use App\Models\Accounts\Warehouse;
use App\Models\User;

class WarehouseService
{


    public function index()
    {
        $warehouses = Warehouse::all();
        return response()->json(['data' => WarehouseResponse::collection($warehouses)], 200);
    }

    public function store($request)
    {
        $warehouse =  Warehouse::create([
            'profile_id' => auth()->user()->profile_id,
            'address_name' => $request->warehouseName,
            'address_contact_phone' => $request->receiverPhone,
            'latitude_longitude' => $request->warehouses,
            'address_contact_name' => $request->receiverName,
            'address_type' => $request->warehouseType,
            'gate_type' => $request->gateType,
            'created_by' => auth()->id(),
            'otp_expires_at' => now()->addMinutes(3),
            'otp_receiver' => strval(rand(1000, 9999)),
        ]);

        if ($warehouse) {
            return response()->json(['message' => 'created successfully'], 200);
        }
        return response()->json(['error' => 'system error'], 500);
    }



    public function update($request, $id)
    {
        $warehouse = Warehouse::where('id', $id)->first();
        if ($warehouse != null) {
            $warehouse->update([
                'address_name' => $request->warehouseName ?? $warehouse->address_name,
                "address_type" => $request->lastName ?? $warehouse->address_type,
                "gate_type" => $request->firstName . " " . $request->lastName ?? $warehouse->gate_type,
                "address_contact_name" => $request->email ?? $warehouse->address_contact_name,
                "address_contact_phone" => $request->address_contact_phone ?? $warehouse->address_contact_phone,
                "latitude_longitude" => $request->warehouses ?? $warehouse->latitude_longitude,

            ]);
        }
        return response()->json(['error' => 'No data Found'], 404);
    }


    public function show($id)
    {
        $warehouses = Warehouse::where('id', $id)->first();
        if ($warehouses != null) {
            return response()->json(['data' => new WarehouseResponse($warehouses)], 200);
        }
        return response()->json(['error' => 'No data Found'], 404);
    }

    public function showByUserId($id)
    {
        $userId = User::find($id)->id;
        $warehouses = Warehouse::where('confirm_by', $userId)->first();
        return response()->json(['data' => new WarehouseResponse($warehouses)], 200);
    }
    public function showByProfileId($id)
    {
        $warehouses = Warehouse::where('profile_id', $id);
        return response()->json(['data' => WarehouseResponse::collection($warehouses)], 200);
    }


    public function delete($id)
    {
        $warehouses = Warehouse::find($id)->first();
        if ($warehouses == null) { // replace false by checking user permission
            return response()->json(['success' => false, 'error' => 'not found'], 404);
        } else {
            $warehouses->delete();
            return response()->json(['message' => 'deleted successfully'], 301);
        }
    }



    public function restore($id)
    {
        $restore = Warehouse::where('id', $id)->withTrashed()->restore();
        if ($restore) {
            return response()->json(['message' => 'restored successfully'], 200);
        }
        return response()->json(['error' => 'system error'], 500);
    }

    public function verfied($request, $id)
    {
        $warehouses = Warehouse::where('id', $id)->first();
        $verfied = $warehouses->update(['confirm_by' => auth()->id(), 'otp_receiver' => null, 'otp_expires_at' => null, 'otp_verfied' => true]);
        if ($verfied) {
            return response()->json(['message' => 'verfied successfully'], 200);
        }
        return response()->json(['error' => 'system error'], 500);
    }
}
