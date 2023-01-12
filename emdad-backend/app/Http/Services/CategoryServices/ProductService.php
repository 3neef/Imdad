<?php

namespace App\Http\Services\CategoryServices;

use App\Http\Collections\ProductsCollection;
use App\Http\Resources\CategoryResourses\Product\ProductResponse;
use App\Http\Services\AccountServices\UploadServices;
use App\Models\Emdad\Product;
use App\Models\Emdad\ProductAttachmentFile;
use App\Models\ProfileCategoryPivot;
use App\Models\ProfileProductsPivot;
use Exception;
use Illuminate\Support\Facades\DB;

class ProductService
{

    public function index($request)
    {
        return ProductResponse::collection(ProductsCollection::collection($request));
    }


    public function store($request)
    {

        $product = DB::transaction(function () use ($request) {
            $product = Product::create([
                'category_id' => $request->categoryId,
                'name_en' => $request->nameEn,
                'name_ar' => $request->nameAr,
                'price' => $request->price??null,
                'measruing_unit' => $request->measruingUnit,
                'description_en' => $request->descriptionEn,
                'description_ar' => $request->descriptionAr,
                'created_by' => auth()->id(),
                'profile_id' => auth()->user()->profile_id,
            ]);
            $product->addMultipleMediaFromRequest(['attachementFile'])
                ->each(function ($fileAdder) {
                    $fileAdder->toMediaCollection('products');
                });
            return $product;
        });
        if ($product) {
            $product->companyProduct()->attach($product->id, ['profile_id' => auth()->user()->profile_id]);
            return response()->json([
                "statusCode" => "000",
                'message' => 'created successfully'
            ], 200);
        }
        return response()->json([
            "statusCode" => '999',
            'error' => 'unkown error'
        ], 500);
    }

    public function update($request, $id)
    {

        $product = Product::find($id);

        // attach the  product to the  meida collection  and update  product 

        
        $product->addMultipleMediaFromRequest(['attachementFile'])
            ->each(function ($fileAdder) {
                $fileAdder->toMediaCollection('products');
            });

        $product->update([
            'category_id' => $request->categoryId ?? $product->category_id,
            'name_ar' => $request->nameAr ?? $product->name_ar,
            'name_en' => $request->nameEn ?? $product->name_en,
            "price" => $request->price ?? $product->price,
            "measruing_unit" => $request->measruing_unit ?? $product->measruing_unit,
            'description_en' => $request->descriptionEn ?? $product->description_en,
            'description_ar' => $request->descriptionAr ?? $product->description_ar
        ]);

        if ($product) {
            return response()->json(["statusCode" => '000', 'message' => 'updated successfully'], 200);
        }
        return response()->json([
            "statusCode" => '999',
            'error' => 'unkown error'
        ], 500);
    }

    public function show($id)
    {
        $product = Product::where('id', $id)->first();
        if ($product) {
            return response()->json(["statusCode" => '000', 'data' => new ProductResponse($product)], 200);
        }
        return response()->json(["statusCode" => '111', 'error' => 'Record Not Founded'], 404);
    }


    public function delete($id)
    {
        $product = Product::find($id);
        $deleted = $product->delete();
        if ($deleted) {
            return response()->json(["statusCode" => '000', 'message' => 'deleted successfully'], 301);
        }
        return response()->json(["statusCode" => '111', 'error' => 'Record Not Found'], 500);
    }

    public function restore($id)
    {
        $restore = Product::where('id', $id)->withTrashed()->restore();
        if ($restore) {
            return response()->json(["statusCode" => '000', 'message' => 'restored successfully'], 200);
        }
        return response()->json(["statusCode" => '111', 'error' => 'Record Not Found'], 500);
    }



    public function setcompanyproducts($request)
    {



        if (isset($request['productList'])) {
            foreach ($request['productList'] as $product_id) {
                ProfileProductsPivot::create([
                    'product_id' => $product_id, 'profile_id' => auth()->user()->profile_id
                ]);
            }
        } else {

            ProfileProductsPivot::create(
                [
                    'product_id' => $request['productId'], 'profile_id' => auth()->user()->profile_id
                ]
            );
        }
        return response()->json(["statusCode" => '000', 'message' => 'created successfully'], 200);
    }


    public function changeProductStatus($request)
    {

        $category = ProfileProductsPivot::where('id', $request->product_id)->first();
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
