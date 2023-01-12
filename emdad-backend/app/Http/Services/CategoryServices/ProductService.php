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
        // $request->merge(['image' => UploadServices::uploadFile($request->attachementFile, 'image', 'Products images')]);
        $prodcut = Product::create([
            'category_id' => $request->categoryId,
            'name_en' => $request->nameEn,
            'name_ar' => $request->nameAr,
            'price' => $request->price,
            'measruing_unit' => $request->measruingUnit,
            'description_en' => $request->descriptionEn,
            'description_ar' => $request->descriptionAr,
            'created_by' => auth()->id(),
            'profile_id' => auth()->user()->profile_id
        ]);
         $prodcut->addMultipleMediaFromRequest(['attachementFile'])
        ->each(function ($fileAdder) {
            $fileAdder->toMediaCollection('products');
        });
        if ($prodcut) {
            $prodcut->companyProduct()->attach($prodcut->id, ['profile_id' => auth()->user()->profile_id]);
            return response()->json([
                "statusCode" => "000",
                'message' => 'created successfully'
            ], 200);
        }
        return response()->json(["statusCode"=>'999',
        'error' => 'unkown error'], 500);
    }

    public function update($request, $id)
    {

        $prodcut = Product::find($id);
        if ($request->has('attachementFile')) {
            $prodcut->addMultipleMediaFromRequest(['attachementFile'])
            ->each(function ($fileAdder) {
                $fileAdder->toMediaCollection('products');
            });

        }

        $prodcut->update([
            'category_id' => $request->categoryId ?? $prodcut->category_id,
            'name_ar' => $request->nameAr ?? $prodcut->name_ar,
            'name_en' => $request->nameEn ?? $prodcut->name_en,
            "price" => $request->price ?? $prodcut->price,
            "measruing_unit" => $request->measruing_unit ?? $prodcut->measruing_unit,
            'description_en' => $request->descriptionEn??$prodcut->description_en,
            'description_ar' => $request->descriptionAr??$prodcut->description_ar
        ]);

        if ($prodcut) {
            return response()->json(["statusCode"=>'000','message' => 'updated successfully'], 200);
        }
        return response()->json(["statusCode"=>'999',
        'error' => 'unkown error'], 500);
    }

    public function show($id)
    {
        $prodcut = Product::where('id', $id)->first();
        if ($prodcut) {
            return response()->json(["statusCode"=>'000','data' => new ProductResponse($prodcut)], 200);
        }
        return response()->json(["statusCode"=>'111','error' => 'Record Not Founded'], 404);
    }


    public function delete($id)
    {
        $prodcut = Product::find($id);
        $deleted = $prodcut->delete();
        if ($deleted) {
            return response()->json(["statusCode"=>'000','message' => 'deleted successfully'], 301);
        }
        return response()->json(["statusCode"=>'111','error' => 'Record Not Found'], 500);
    }

    public function restore($id)
    {
        $restore = Product::where('id', $id)->withTrashed()->restore();
        if ($restore) {
            return response()->json(["statusCode"=>'000','message' => 'restored successfully'], 200);
        }
        return response()->json(["statusCode"=>'111','error' => 'Record Not Found'], 500);
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
         
            ProfileProductsPivot::create([
                'product_id' => $request['productId'], 'profile_id' => auth()->user()->profile_id]
            );
        }
            return response()->json(["statusCode"=>'000','message' => 'created successfully'], 200);

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
