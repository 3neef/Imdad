<?php
namespace App\Http\Services\UMServices;

use App\Http\Resources\UMResources\Permission\PermissionResponse;
use App\Models\UM\Permission;
use App\Models\UM\RolePermission;
use App\Models\UM\Role;



class PermissionServices{
    public function createOrUpdate($request)
    {
        // dd($request);
        $colmun = gettype($request ->json()->get( 'role' )) == 'integer' ? 'id' : 'name';
        $role = Role::where( $colmun, $request ->json()->get( 'role' ) )->first();
        $exists= $role->permissions();
        $json = json_encode( $request ->json()->get( 'privileges' ), true );
        if(empty($exists)){
            return $this->create($json,$role);
        }else{
            return $this->update($json,$role->id);
        }
    }

    public function create($json,$role)
    {
        $Permissions =new RolePermission();
        $Permissions->json = $json;
        $Permissions->role_id=$role->id;
        $result = $Permissions->save();
        if($result){
            return response()->json( [ 'message'=>'created successfully' ], 200 );
        }
        return response()->json( [ 'error'=>'system error' ], 500 );
    }

    public function update($json,$roleId)
    {
        $Permission = RolePermission::where('role_id','=',$roleId)->first();
        $update = $Permission->update(['json' => $json]);
        if($update){
            return response()->json( [ 'message'=>'updated successfully' ], 200 );
        }
        return response()->json( [ 'error'=>'system error' ], 500 );
    }

    public function showAll(){
        $allPermissions = Permission::all();
        return response()->json(['data' => PermissionResponse::collection($allPermissions)  ]);
    }

    public function showById($id)
    {
        $Permissions = RolePermission::select( [ 'json as privilege' ] )->where( 'role_id', $id )->get();
        if(empty($Permissions)){
            return response()->json( [ 'data'=> 'this role do not have privileges' ], 200 );
        }
        foreach ( $Permissions as $rolesPrivilege ) {
            $rolesPrivilege->privilege = json_decode( $rolesPrivilege->privilege );
        }
        return response()->json( [ 'data'=>$Permissions ], 200 );
    }

    public function delete($id)
    {
        $Permissions = RolePermission::find($id);
        $deleted = $Permissions->delete();
        if($deleted){
            return response()->json( [ 'message'=>'deleted successfully' ], 301 );
        }
        return response()->json( [ 'error'=>'system error' ], 500 );
    }

    public function restoreById($id)
    {
       $restore = RolePermission::where('id', $id)->withTrashed()->restore();
       if($restore){
            return response()->json( [ 'message'=>'restored successfully' ], 200 );
       }
       return response()->json( [ 'error'=>'system error' ], 500 );
    }
}