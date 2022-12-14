<?php

namespace App\Http\Services\CategoryServices;

use App\Models\Emdad\Categories;

class CategoryService
{

    public function store($request)
    {

        $category = Categories::create([
            'name_en' => $request->nameEn,
            'name_ar' => $request->nameAr,
            'aproved' => 0,
            'isleaf' => $request->isleaf,
            'parent_id' => $request->parentId ?? 0,

        ]);
        if(auth()->user()->profile_id){
            $category->update(['profile_id' => auth()->user()->profile_id]);
        }
        if ($category) {
            return response()->json(['message' => 'created successfully'], 200);
        }
        return response()->json(['message'=>'error'],501);
    }





    
    public function approveCategory($category_id)
    {
        $category = Categories::find($category_id)->first();
        if ($category == null) {
            return response()->json([
                'error' => 'error in created'
            ]);
        } else {
            $category->aproved = 1;
            $category->update();
            return response()->json(['message' => 'aproved successfully'], 200);
        }
    }

    public function showAllApprovedCategories()
    {
        $category = Categories::where('aproved', '1')->get();
        return  response()->json(['data' => $category], 200);
    }

    public function showAllCategories()
    {
        $category = Categories::get();
        return  response()->json(['Maincategory' => $category], 200);
    }

    public function addSubCategory($request)
    {
        $subcatogry = Categories::where('name', $request->name)->where('parent_id', '=', $request->parent_id)->first();
        if ($subcatogry != null) {
            return response()->json([
                'error' => 'error in created'
            ]);
        } else {

            $aproved = 0;
            $subcatogry = Categories::create([
                'name' => $request->name,
                'aproved' => $aproved,
                'isleaf' => $request->isleaf,
                'parent_id' => $request->parent_id,
                'company_id' => auth()->user()->default_company, //change to Auth()->user()->company_id (befor add middleware)
            ]);

            return response()->json(['message' => 'created successfully'], 200);
        }
    }


    public function showApprovedWithParentCategoryId($request)
    {
        if ($request->aproved == 1) {
            $subcategory = Categories::where('aproved', '1')->where('parent_id', $request->parent_id)->get();
            return  response()->json([
                'subcategory' => $subcategory,
            ]);
        } else {
            $subcategory = Categories::where('parent_id', $request->parent_id)->get();
            return  response()->json([
                'subcategory' => $subcategory,
            ]);
        }
    }


    public function showCategoriesByCompanyId($companyId)
    {
        $categorys = Categories::where('company_id', '=', $companyId);
        return response()->json(['data' => $categorys], 200);
    }
}
