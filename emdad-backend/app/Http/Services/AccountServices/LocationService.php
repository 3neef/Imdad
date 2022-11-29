<?php

namespace App\Http\Services\AccountServices;

use App\Http\Resources\AccountResourses\Location\LocationResponse;
use Carbon\Carbon;
use App\Models\Accounts\CompanyInfo;
use Illuminate\Support\Facades\Auth;
use App\Models\Accounts\CompanyLocations;
use App\Models\User;

class LocationService
{

    public function save($request)
    {

        $location =  CompanyLocations::create([
            'company_id' => auth() -> user() -> default_company,
            'address_name' => $request->warehouseName,
            'address_contact_phone' => $request->receiverPhone,
            'latitude_longitude' => $request->location,
            'address_contact_name' => $request->receiverName,
            'address_type' => $request->warehouseType,
            'gate_type' => $request->gateType,
            'created_by' => auth()->id(),
            'otp_expires_at' => now()->addMinutes(3),
            'otp_receiver' => strval(rand(1000, 9999)),
        ]);

        if ($location) {
            return response()->json(['message' => 'created successfully'], 200);
        }
        return response()->json(['error' => 'system error'], 500);
    }

    public function update($request)
    {
    $location = CompanyLocations::where('id', $request->id)->first();
        $location->update([
            'address_name' => $request->warehouseName ?? $location->address_name,
            "address_type" => $request->lastName ?? $location->address_type,
            "gate_type" => $request->firstName . " " . $request->lastName ?? $location->gate_type,
            "address_contact_name" => $request->email ?? $location->address_contact_name,
            "address_contact_phone" => $request->address_contact_phone ?? $location->address_contact_phone,
            "latitude_longitude" => $request->location ?? $location->latitude_longitude,

        ]);

        if ($location) {
                return response()->json(['message' => 'updated successfully'], 200);
            }
            return response()->json(['error' => 'system error'], 500);


    }

    public function showById($id)
    {
        $location = CompanyLocations::where('id', $id)->get();
        return response()->json(['data' => new LocationResponse($location)], 200);
    }

    public function showByUserId($id)
    {
        $userId = User::find($id)->id;
        $location = CompanyLocations::where('confirm_by', $userId)->first();
        return response()->json(['data' => new LocationResponse($location)], 200);
    }
    public function showByCompanyId($id)
    {
        $location = CompanyLocations::where('company_id', $id);
        return response()->json(['data' => LocationResponse::collection($location)], 200);
    }

    public function getAll()
    {
        $allLocations = CompanyLocations::all();
        return response()->json(['data' => LocationResponse::collection($allLocations)], 200);
    }

    public function delete($id)
    {
        $location = CompanyLocations::find($id);
        $deleted = $location->delete();
        if ($deleted) {
            return response()->json(['message' => 'deleted successfully'], 301);
        }
        return response()->json(['error' => 'system error'], 500);
    }
    public function restore($id)
    {
        $restore = CompanyLocations::where('id', $id)->withTrashed()->restore();
        if ($restore) {
            return response()->json(['message' => 'restored successfully'], 200);
        }
        return response()->json(['error' => 'system error'], 500);
    }

    public function verfied($request)
    {
        $userId = $request->get('userId');
        $id = $request->get('id');
        $companyId = $request->get('companyId');
        $location = CompanyLocations::where('id', '=', $id)->where('company_id', '=', $companyId)->first();
        $verfied = $location->update(['confirm_by' => $userId, 'otp_receiver' => null, 'otp_expires_at' => null, 'otp_verfied' => true]);
        if ($verfied) {
            return response()->json(['message' => 'verfied successfully'], 200);
        }
        return response()->json(['error' => 'system error'], 500);
    }
}
