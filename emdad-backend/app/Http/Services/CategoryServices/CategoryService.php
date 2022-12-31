<?php

namespace App\Http\Services\CategoryServices;

use App\Http\Collections\CategoryCollection;
use App\Http\Resources\CategoryResourses\category\CategoryResource;
use App\Models\Emdad\Categories;
use Exception;

class CategoryService
{



    public function index($request)
    {
        return CategoryCollection::collection($request);
    }


    public function store($request)
    {
        try {
            $category = Categories::create([
                'name_en' => $request->nameEn,
                'name_ar' => $request->nameAr,
                'isleaf' => $request->isleaf,
                'parent_id' => $request->parentId ?? 0
            ]);
            if ($category) {
                $category->companyCategory()->attach($category->id,['category_id' => $category->id, 'profile_id' => auth()->user()->profile_id]);
            }
            if (auth()->user()->profile_id) {
                $category->update(['profile_id' => auth()->user()->profile_id ?? null]);
            }
            if ($category) {
                return response()->json(['message' => 'created successfully'], 200);
            }
        }
        catch(Exception $e){
        }
        return response()->json(['message' => 'error'], 501);
    }





    public function show($id)
    {
        $category = Categories::where('id', $id)->first();
        if ($category) {
            return response()->json(['data' => new CategoryResource($category)], 200);  
        }
        return response()->json(['error' => 'No data Founded'], 404);
    }






    public function update($request, $id)
    {
        $category = Categories::where('id', $id)->first();

        if ($category != null) {
            $category->update([
                'name_en' => $request->nameEn ?? $category->name_en,
                'name_ar' => $request->nameAr ?? $category->name_ar,
                'isleaf' => $request->isleaf ?? $category->isleaf,
                'parent_id' => $request->parentId ?? $category->parent_id,
                "status" => $request->status ?? $category->status,
                "reason" => $request->reason ?? $category->reason,
            ]);
            return response()->json(['success' => 'Updated Successfly'], 201);
        }
        return response()->json(['error' => false, 'message' => 'not found'], 404);
    }

    public function destroy($id)
    {
        $category = Categories::find($id);
        if ($category == null) {
            return response()->json(['success' => false, 'error' => 'not found'], 404);
        } else {
            $category->delete();
            return response()->json(['message' => 'deleted successfully'], 301);
        }
    }


    public function restore($id)
    {
        $restore = Categories::where('id', $id)->where('deleted_at', '!=', null)->withTrashed()->restore();
        if ($restore) {
            return response()->json(['message' => 'restored successfully'], 200);
        }
        return response()->json(['error' => 'system error'], 500);
    }


    // public function approveCategory($id)
    // {
    //     $category = Categories::find($id);
    //     if ($category == null) {
    //         return response()->json([
    //             'error' => 'no category founded'
    //         ]);
    //     } else {
    //         $category->update(['status' => 'aproved']);
    //         return response()->json(['message' => 'aproved successfully'], 200);
    //     }
    // }
}
