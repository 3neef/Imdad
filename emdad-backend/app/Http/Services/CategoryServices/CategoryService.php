<?php
namespace App\Http\Services\CategoryServices;

use App\Models\Emdad\Categories;

class CategoryService{


    public function addcatogre($request)
    {
        $catogry = Categories::where('name', $request->name)->first();
        if ($catogry != null) {
            return response()->json([
                'خطا في الاضافة'
            ]);
        } else {
            $aproved = 0;
            $parentid = 0;
            $category = Categories::create([
                'name' => $request->name,
                'aproved' => $aproved,
                'isleaf' => $request->isleaf,
                'parent_id' => $parentid,
            ]);

            return response()->json([
                'تمت   الاضافة'
            ]);
        }
    }



    public function aprovedcatogre($catogre_id)
    {
        $category = Categories::find($catogre_id);
        if (!$category) {
            return response()->json([
                'خطا في التعديل'
            ]);
        } else {
            $category->aproved = 1;
            $category->update();
            return response()->json([
                'تم   التعديل'
            ]);
        }
    }

    public function showallaprovedcatogre()
    {
        $category = Categories::where('aproved', '1')->get();
        return  response()->json([
            'data' => $category,
        ]);
    }

    public function showallcatogre()
    {
        $category = Categories::get();
        return  response()->json([
            'Maincatogre' => $category,
        ]);
    }

    public function addsubCatogre($request)
    {
        $subcatogry = Categories::where('name', $request->name)->where('parent_id', '=', $request->parent_id)->first();
        if ($subcatogry != null) {
            return response()->json([
                'خطا في الاضافة'
            ]);
        } else {

            $aproved = 0;
            $subcatogry = Categories::create([
                'name' => $request->name,
                'aproved' => $aproved,
                'isleaf' => $request->isleaf,
                'parent_id' => 0,
            ]);

            return response()->json([
                'تمت   الاضافة'
            ]);
        }
    }


    public function showwithcatogreid($request)
    {
        if ($request->aproved == 1) {
            $subcategory = Categories::where('aproved', '1')->where('parent_id', $request->parent_id)->get();
            return  response()->json([
                'subcatogre' => $subcategory,
            ]);
        } else {
            $subcategory = Categories::where('parent_id', $request->parent_id)->get();
            return  response()->json([
                'subcatogre' => $subcategory,
            ]);
        }
    }
    public function aprovedsubcatogre($catogre_id)
    {
        $subcategory = Categories::find($catogre_id);
        if (!$subcategory) {
            return response()->json([
                'خطا في التعديل'
            ]);
        } else {
            $subcategory->aproved = 1;
            $subcategory->update();
            return response()->json([
                'تم   التعديل'
            ]);
        }
    }


}