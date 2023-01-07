<?php

namespace App\Http\Services\CategoryServices;

use App\Http\Collections\CategoryCollection;
use App\Http\Resources\CategoryResourses\category\CategoryResource;
use App\Models\Emdad\Categories;
use App\Models\ProfileCategoryPivot;
use Exception;
use Illuminate\Support\Facades\DB;

class CategoryService
{



    public function index($request)
    {
        return CategoryCollection::collection($request);
    }


    public function store($request)
    {
        $category = DB::transaction(function () use ($request) {
            $category = Categories::create([
                'name_en' => $request->nameEn,
                'name_ar' => $request->nameAr,
                'isleaf' => $request->isleaf ?? 0,
                'parent_id' => $request->parentId ?? 0,
                "reason" => $request->note,
                'type' => $request->type ?? 'products',
            ]);
            if ($category) {
                $category->companyCategory()->attach($category->id, ['category_id' => $category->id, 'profile_id' => auth()->user()->profile_id,'created_by'=>auth()->id()]);
            }
            if (auth()->user()->profile_id) {
                $category->update(['profile_id' => auth()->user()->profile_id]);
            }
            return $category;
        });
        if ($category) {
            return response()->json([
                "statusCode" => "000",
                'message' => 'created successfully',
                'data' => new CategoryResource($category)
            ], 200);
        }
        return response()->json([
            "statusCode" => "264",
            'success' => false, 'message' => "User Dosn't belong to any profile "
        ], 200);
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
                'type' => $request->type ?? $category->type,
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

    public function setCategories($request)
    {
        $category = Categories::first();
        if (isset($request['categoryList'])) {
            foreach ($request['categoryList'] as $category_id) {
                try {
                    $category->companyCategory()->attach($category->id, ['category_id' => $category_id, 'profile_id' => auth()->user()->profile_id,'created_by'=>auth()->id()]);
                } catch (Exception $e) {
                }
            }
        } else {
            $category->companyCategory()->attach($category->id, ['category_id' => $request->category_id, 'profile_id' => auth()->user()->profile_id,'created_by'=>auth()->id()]);
        }
        return response()->json(['message' => 'created successfully'], 200);
    }

    public function RetryApproval($request)
    {
        $category = ProfileCategoryPivot::where('category_id', $request->categoryId)->where('profile_id', auth()->user()->profile_id)->first();

        if ($category->status == "rejected") {
            $category->update([
                "status" => "pending",
                "reason" => $request->reason ?? $category->reason,
            ]);
            return response()->json(['message' => 'Approval  Requset sent successfully'], 200);
        }
        return response()->json(['message' => 'Requset  not sent '], 403);
    }

    public function changeCategoryStatus($request)
    {

        $category = ProfileCategoryPivot::where('id', $request->category_id)->first();
        if ($category == null) {
            return response()->json([
                'error' => 'No categories founded'
            ]);
        } else {
            $category->update(['status' => 'inActive']);
            return response()->json(['message' => 'changed successfully'], 200);
        }
    }


    public function approveCategory($request)
    {
        $category = Categories::where('id', $request->category_id)->first();
        if ($category == null) {
            return response()->json([
                'error' => 'No category founded'
            ]);
        } else {
            $category->update(['status' => 'aproved']);
            return response()->json(['message' => 'aproved successfully'], 200);
        }
    }


    public function rejectCategory($request)
    {
        $category = Categories::where('id', $request->category_id)->first();
        if ($category == null) {
            return response()->json([
                'error' => 'No category founded'
            ]);
        } else {
            $category->update([
                'status' => 'rejected',
            ]);
            return response()->json(['message' => 'rejected successfully'], 200);
        }
    }
    public function filterCategory($request)
    {
        $category = Categories::where('type', $request->type)->get();


        if ($category == null) {
            return response()->json(['error' => 'No category founded']);
        }
        return response()->json([
            "statusCode" => "000",
            'data' => new CategoryResource($category)
        ]);
    }

    public function getCategoryProfile($request)
    {
       
        if (auth()->user()->profile_id == null) {
            return response()->json(["error" => "", "code" => "100", "message" => "category does not have profile"], 200);
        } else {
            
            $categories = DB::table('categories')->select('*')
                ->join('profile_category_pivots', 'profile_category_pivots.category_id', '=', 'categories.id')->where('profile_category_pivots.profile_id', auth()->user()->profile_id)
                ->join('users', 'profile_category_pivots.created_by', '=', 'users.id')->where('users.profile_id', auth()->user()->profile_id)->get();
            return response()->json(["success" => true, "code" => "200", "data" => $categories], 200);
        }
    }
    
}
