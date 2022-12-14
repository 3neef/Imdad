<?php

namespace App\Http\Services\CategoryServices;

use App\Http\Resources\CategoryResourses\Product\ProductResponse;
use App\Http\Services\AccountServices\UploadServices;
use App\Models\Emdad\Prodcuts;
use App\Models\Emdad\Product;
use App\Models\Emdad\Unit_of_measures;

class ProductService
{

    public function index()
    {
        $prodcuts = Product::all();
        if ($prodcuts) {
            return response()->json(['data' => ProductResponse::collection($prodcuts)], 200);
        }
        return response()->json(['error' => 'No data Founded'], 404);
    }

    public function store($request)
    {
        $request->merge(['image' => UploadServices::uploadFile($request->attachement_file, 'image', 'Products images')]);

        $prodcut = Product::create([
            'category_id' => $request->categoryId,
            'name' => $request->name,
            "price" => $request->price,
            "measruing_unit" => $request->measruing_unit,
            "image" => $request->image,

        ]);
        if ($prodcut) {
            return response()->json(['message' => 'created successfully'], 200);
        }
        return response()->json(['error' => 'system error'], 500);
    }


    public function update($request, $id)
    {

        $prodcut = Product::find($id);

        $prodcut->update([
            'category_id' => $request->categoryId,
            'name' => $request->name,
            "price" => $request->price,
            "measruing_unit" => $request->measruing_unit,
        ]);
        if ($request->has('image')) {
            $request->merge(['image' => UploadServices::uploadFile($request->attachement_file, 'image', 'Products images')]);
            $prodcut->update(['image' => $request->image]);
        }
        if ($prodcut) {
            return response()->json(['message' => 'updated successfully'], 200);
        }
        return response()->json(['error' => 'system error'], 500);
    }

    public function show($id)
    {
        $prodcut = Product::where('id', $id)->first();
        if ($prodcut) {
            return response()->json(['data' => new ProductResponse($prodcut)], 200);
        }
        return response()->json(['error' => 'No data Founded'], 404);
    }


    public function delete($id)
    {
        $prodcut = Product::find($id);
        $deleted = $prodcut->delete();
        if ($deleted) {
            return response()->json(['message' => 'deleted successfully'], 301);
        }
        return response()->json(['error' => 'system error'], 500);
    }

    public function restore($id)
    {
        $restore = Product::where('id', $id)->withTrashed()->restore();
        if ($restore) {
            return response()->json(['message' => 'restored successfully'], 200);
        }
        return response()->json(['error' => 'system error'], 500);
    }
}
