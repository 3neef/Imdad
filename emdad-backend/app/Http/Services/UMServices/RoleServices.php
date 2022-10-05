<?php
namespace App\Http\Services\UMServices;

use App\Models\UM\Role;


class RoleServices{

    public function create($request)
    {
        if(!$request->isMethod('post')){
            return response()->json( [ 'error'=>'is route supported post method only' ], 402 );
        }
        $role = new Role();
        $role->name = $request->get('name');
        $result =$role->save();
        if ($result) {
            return response()->json( [ 'message'=>'created successfully' ], 200 );
        }
        return response()->json( [ 'error'=>'system error' ], 500 );
    }

    public function update($request)
    {
        $role = Role::find($request->get('id'));
        $result=$role->update(['name' => $request->get('name')]);
        if($result){
            return response()->json( [ 'message'=>'updated successfully' ], 200 );
        }
        return response()->json( [ 'error'=>'system error' ], 500 );
    }

    public function showAll(){
        $roles = Role::all();
        return response()->json(['data' => $roles ]);
    }

    public function showById($id)
    {
        $role = Role::where( 'id', $id )->get();
        return response()->json( [ 'data'=>$role ], 200 );
    }

    public function delete($id)
    {
        $role = Role::find($id);
        $deleted = $role->delete();
        if($deleted){
            return response()->json( [ 'message'=>'deleted successfully' ], 301 );
        }
        return response()->json( [ 'error'=>'system error' ], 500 );
    }

    public function restoreById($id)
    {
       $restore = Role::where('id', $id)->withTrashed()->restore();
       if($restore){
            return response()->json( [ 'message'=>'restored successfully' ], 200 );
       }
       return response()->json( [ 'error'=>'system error' ], 500 );
    }

}