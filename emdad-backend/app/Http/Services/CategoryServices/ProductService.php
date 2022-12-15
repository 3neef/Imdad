<?php

namespace App\Http\Services\CategoryServices;
use App\Http\Collections\ProductsCollection;
use App\Http\Resources\CategoryResourses\Product\ProductResponse;
use App\Http\Services\AccountServices\UploadServices;
use App\Models\Emdad\Product;

class ProductService
{

    public function index()
    {
        return ProductsCollection::collection();
    }


    public function store($request)
    {
        // dd($request->all());
        $request->merge(['image' => UploadServices::uploadFile($request->attachementFile, 'image', 'Products images')]);

        $prodcut = Product::create([
            'category_id' => $request->categoryId,
            'name' => $request->name,
            "price" => $request->price,
            "measruing_unit" => $request->measruingUnit,
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
        if ($request->has('attachementFile')) {
            $request->merge(['image' => UploadServices::uploadFile($request->attachementFile, 'image', 'Products images')]);
        }

        $prodcut->update([
            'category_id' => $request->categoryId ?? $prodcut->category_id,
            'name' => $request->name ?? $prodcut->name,
            "price" => $request->price ?? $prodcut->price,
            "measruing_unit" => $request->measruing_unit ?? $prodcut->measruing_unit,
            'image' => $request->image ?? $prodcut->image,
        ]);

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
