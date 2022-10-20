<?php

namespace App\Http\Services\CategoryServices;

use App\Http\Resources\CategoryResourses\Product\ProductResponse;
use App\Models\Emdad\Prodcuts;

class ProductService{

    public function createProdcut($request)
    {
        $prodcut = new Prodcuts();
        $categoryId = $request->get('categoryId');
        $prodcut->name = $request->get('name');
        $prodcut->categories_id = $categoryId;
        $prodcut->price = $request->get('price');
        $result = $prodcut->save();
        if($result){
            return response()->json( [ 'message'=>'created successfully' ], 200 );
        }
        return response()->json( [ 'error'=>'system error' ], 500 );
    }

    public function update($request)
    {
        $id = $request->get('id');
        $prodcut = Prodcuts::find($id);
        $name = empty($request->get('name')) ? $prodcut->name : $request->get('name');
        $price = empty( $request->get('price')) ? $prodcut->price :  $request->get('price');
        $update = $prodcut->update(['name' => $name,'price' => $price]);
        if($update){
            return response()->json( [ 'message'=>'updated successfully' ], 200 );
        }
        return response()->json( [ 'error'=>'system error' ], 500 );
    }

    public function getById($id)
    {
        $prodcut = Prodcuts::where( 'id', $id )->get();
        return response()->json( [ 'data'=>new ProductResponse($prodcut)  ], 200 );
    }

    public function getAll()
    {
        $allProdcuts = Prodcuts::all();
        return response()->json( [ 'data'=>ProductResponse::collection($allProdcuts) ], 200 );
    }

    public function delete($id)
    {
        $prodcut = Prodcuts::find($id);
        $deleted = $prodcut->delete();
        if($deleted){
            return response()->json( [ 'message'=>'deleted successfully' ], 301 );
        }
        return response()->json( [ 'error'=>'system error' ], 500 );
    }

    public function restore($id)
    {
        $restore = Prodcuts::where('id', $id)->withTrashed()->restore();
        if($restore){
             return response()->json( [ 'message'=>'restored successfully' ], 200 );
        }
        return response()->json( [ 'error'=>'system error' ], 500 );
    }
}