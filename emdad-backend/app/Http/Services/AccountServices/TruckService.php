<?php

namespace App\Http\Services\AccountServices;

use App\Http\Collections\TruckCollection;
use App\Http\Resources\AccountResourses\warehouses\TruckResponse;
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
                'brand' => $request->brand,
                'created_by' => auth()->user()->profile_id
            ]);
            $request->merge(['image' => UploadServices::uploadFile($request->image, 'image', 'truck images')]);
            $truck->truckImage()->create(['name' => $request->image, 'truck_id' => $truck->id]);
        });
        return response()->json(['message' => 'created successfully'], 201);
    }



    public function update($request, $id)
    {
        $truck = Truck::where('id', $id)->first();
        if ($truck != null) {
            $truck->update([
                'name' => $request->name ?? $truck->name,
                "type" => $request->type ?? $truck->type,
                "class" => $request->class ?? $truck->class,
                "color" => $request->color ?? $truck->color,
                "model" => $request->model ?? $truck->model,
                "size" => $request->size ?? $truck->size,
                "brand" => $request->brand ?? $truck->brand,
            ]);
            if ($request->has('image')) {
                $request->merge(['image' => UploadServices::uploadFile($request->image, 'image', 'truck images')]);
                $truck->truckImage()->update(['name' => $request->image, 'truck_id' => $truck->id]);
            }

            return response()->json(['success' => 'Updated Successfly'], 201);
        }
    }

    public function suspend($request, $id)
    {
        $truck = Truck::find($id);

        if ($truck) {
            if ($request->status == 'inActive') {
                $truck->update([
                    'status' => $request->status
                ]);
                return response()->json(['message' => "Suspended Successfly"], 201);
            } else {
                $truck->update([
                    'status' => $request->status
                ]);
                return response()->json(['message' => "Activated Successfly"], 201);
            }
        }
        return response()->json(['error' => "System Error"], 403);
    }



    public function delete($id)
    {
        $truck = Truck::find($id);
        if ($truck == null) {
            return response()->json(['success' => false, 'error' => 'not found'], 404);
        } else {
            $truck->delete();
            return response()->json(['message' => 'deleted successfully'], 301);
        }
    }



    public function restore($id)
    {
        $restore = Truck::where('id', $id)->withTrashed()->restore();
        if ($restore) {
            return response()->json(['message' => 'restored successfully'], 200);
        }
        return response()->json(['error' => 'system error'], 500);
    }


    public function index($request)
    {
        return  TruckCollection::collection($request);
    }
}
