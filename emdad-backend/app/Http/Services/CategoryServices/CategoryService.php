<?php
namespace App\Http\Services\CategoryServices;

use App\Models\Emdad\Categories;

class CategoryService{


    public function addcatogre($request)
    {
        $catogry = Categories::where('name', $request->name)->first();
        if ($catogry != null) {
            return response()->json([
                'error'=>'error in created'
            ]);
        } else {
            $aproved = 0;
            $parentid = 0;
            $category = Categories::create([
                'name' => $request->name,
                'aproved' => $aproved,
                'isleaf' => $request->isleaf,
                'parent_id' => $parentid,
                'company_id' => $request->companyId,
            ]);

            return response()->json( [ 'message'=>'created successfully' ], 201 );
        }
    }



    public function aprovedcatogre($catogre_id)
    {
        $category = Categories::find($catogre_id);
        if (!$category) {
            return response()->json([
                'error'=>'error in created'
            ]);
        } else {
            $category->aproved = 1;
            $category->update();
            return response()->json( [ 'message'=>'updated successfully' ], 200 );
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
              'error'=>'error in created'
            ]);
        } else {

            $aproved = 0;
            $subcatogry = Categories::create([
                'name' => $request->name,
                'aproved' => $aproved,
                'isleaf' => $request->isleaf,
                'parent_id' => $request->parent_id,
                'company_id' => $request->companyId, //change to Auth()->user()->company_id (befor add middleware)
            ]);

            return response()->json( [ 'message'=>'created successfully' ], 200 );
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
        $subcategory->aproved = 1;
        $subcategory->update();
        return response()->json( [ 'message'=>'updated successfully' ], 200 );
    }

    public function showByCompanyId($companyId)
    {
        $categorys = Categories::where('company_id','=',$companyId);
        return response()->json( [ 'data'=>$categorys ], 200 );
    }

}