<?php

namespace App\Http\Services\AccountServices;

use App\Http\Resources\Delviery\DriverResources;
use App\Models\Accounts\Driver;
use Illuminate\Http\Request;

class DriverService
{

    public function index(Request $request)
    {
        $drivers = Driver::all();

        if ($drivers) {
            return response()->json(['data' => DriverResources::collection($drivers)], 201);
        }
        return response()->json(['message' => "No data founded"], 404);
    }

    public function store($request)
    {
        $drivers = Driver::create([
            'name_ar' => $request->nameAr,
            'name_en' => $request->nameEn,
            'age' => $request->age,
            "nationality" => $request->nationality,
            "phone" => $request->phone
        ]);
        if ($drivers) {
            return response()->json(['message' => "created Successfly"], 201);
        }
        return response()->json(['error' => "System Error"], 403);
    }

    public function show($id)
    {
        $driver = Driver::find($id);
        if ($driver) {
            return response()->json(['data' => $driver], 201);
        }
        return response()->json(['error' => "System Error"], 403);
    }

    public function update($request, $id)
    {
        $driver = Driver::find($id);
        if ($driver) {
            $driver->update([
                'name_ar' => $request->nameAr ?? $driver->name_ar,
                'name_en' => $request->nameEn ?? $driver->name_en,
                'age' => $request->age ?? $driver->age,
                "nationality" => $request->nationality ?? $driver->nationality,
                "phone" => $request->phone ?? $driver->phone
            ]);
            return response()->json(['message' => "updated Successfly"], 201);
        }
        return response()->json(['error' => "System Error"], 403);
    }

    public function destroy($id)
    {
        $driver = Driver::find($id);

        if ($driver) {
            $driver->delete();
            return response()->json(['message' => "deleted Successfly"], 201);
        }
        return response()->json(['error' => "System Error"], 403);
    }

    public function suspend($request, $id)
    {
        $driver = Driver::find($id);

        if ($driver) {
            if ($request->status == 'inActive'){
                $driver->update([
                    'status' => $request->status
                ]);
                return response()->json(['message' => "Suspended Successfly"], 201);
            }else{
                $driver->update([
                    'status' => $request->status
                ]);
                return response()->json(['message' => "Activated Successfly"], 201);
            }
        }
        return response()->json(['error' => "System Error"], 403);
    }

    public function restore($id)
    {
        $driver = Driver::where('id', $id)->withTrashed()->restore();
        if ($driver) {
            return response()->json(['message' => "restored Successfly"], 201);
        }
        return response()->json(['error' => "System Error"], 403);
    }
}
