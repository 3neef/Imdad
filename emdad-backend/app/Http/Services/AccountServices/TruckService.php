<?php

namespace App\Http\Services\AccountServices;

use App\Models\Accounts\Truck;
use Illuminate\Support\Facades\DB;

class TruckService
{

    public function store($request)
    {
        DB::transaction(function () use ($request) {
            $truck = Truck::create([
                'name' => $request->name,
                'type' => $request->type,
                'class' => $request->class,
                'color' => $request->color,
                'model' => $request->model,
                'size' => $request->size,
                'brand' => $request->brand
            ]);
            $request->merge(['image' => UploadServices::uploadFile($request->image, 'image', 'truck images')]);
            $truck->truckImage()->create(['name' => $request->image, 'truck_id' => $truck->id]);
        });
        return response()->json(['message' => 'created successfully'], 201);
    }
}
