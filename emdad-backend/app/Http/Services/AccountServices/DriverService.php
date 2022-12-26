<?php

namespace App\Http\Services\AccountServices;

use App\Http\Resources\Delviery\DriverResources;
use App\Models\Accounts\Driver;

class DriverService
{

    public function index(Request $request)
    {
        $dirvers = Driver::all();

        if ($dirvers) {
            return response()->json(['data' => DriverResources::collection($dirvers)], 201);
        }
        return response()->json(['message' => "No data founded"], 404);
    }

    public function store($request)
    {
        $dirvers = Driver::create([
            'name_ar' => $request->nameAr,
            'name_en' => $request->nameEn,
            'age' => $request->age,
            "nationality" => $request->nationality,
            "phone" => $request->phone
        ]);
        if ($dirvers) {
            return response()->json(['message' => "created Successfly"], 201);
        }
        return response()->json(['error' => "System Error"], 403);
    }

    public function show($id)
    {
        $dirver = Driver::find($id);
        if ($dirver) {
            return response()->json(['data' => $dirver], 201);
        }
        return response()->json(['error' => "System Error"], 403);
    }

    public function update($request, $id)
    {
        $dirver = Driver::find($id);
        if ($dirver) {
            $dirver->update([
                'name_ar' => $request->nameAr ?? $dirver->name_ar,
                'name_en' => $request->nameEn ?? $dirver->name_en,
                'age' => $request->age ?? $dirver->age,
                "nationality" => $request->nationality ?? $dirver->nationality,
                "phone" => $request->phone ?? $dirver->phone
            ]);
            return response()->json(['message' => "updated Successfly"], 201);
        }
        return response()->json(['error' => "System Error"], 403);
    }

    public function destroy($id)
    {
        $dirver = Driver::find($id);

        if ($dirver) {
            $dirver->delete();
            return response()->json(['message' => "deleted Successfly"], 201);
        }
        return response()->json(['error' => "System Error"], 403);
    }

    public function restore($id)
    {
        $dirver = Driver::where('id', $id)->withTrashed()->restore();
        if ($dirver) {
            return response()->json(['message' => "restored Successfly"], 201);
        }
        return response()->json(['error' => "System Error"], 403);
    }
}
