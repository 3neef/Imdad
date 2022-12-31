<?php

namespace App\Http\Services\CategoryServices;

use App\Http\Collections\ProductsCollection;
use App\Http\Resources\CategoryResourses\Product\ProductResponse;
use App\Http\Services\AccountServices\UploadServices;
use App\Models\Emdad\Product;
use App\Models\ProfileCategoryPivot;
use App\Models\ProfileProductsPivot;
use Exception;

class ProductService
{

    public function index($request)
    {
        return ProductsCollection::collection($request);
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
            $prodcut->companyProduct()->attach($prodcut->id, ['profile_id' => auth()->user()->profile_id]);
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



    public function setcompanyproducts($request)
    {

        $product = Product::first();
        if (isset($request['productList'])) {
            foreach ($request['productList'] as $product_id) {
         $product->companyProduct()->attach(['product_id' => $product_id, 'profile_id' => auth()->user()->profile_id]);
            } 
            
        } else {
          $product->companyProduct()->attach(['product_id' => $request, 'profile_id' => auth()->user()->profile_id]);
            }
            return response()->json(['message' => 'created successfully'], 200);

        }
       
    
public function changeProductStatus($request)
    {        

        $category = ProfileProductsPivot::where('id',$request->product_id)->first();
        if ($category == null) {
            return response()->json([
                'error' => 'No products founded'
            ]);
        } else {
            $category->update(['status' => 0]);
            return response()->json(['message' => 'aproved successfully'], 200);
        }
    }



}
