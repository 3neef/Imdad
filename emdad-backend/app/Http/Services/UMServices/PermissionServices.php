<?php

namespace App\Http\Services\UMServices;

use App\Http\Resources\UMResources\Permission\PermissionResponse;
use App\Models\UM\Permission;
use App\Models\UM\RolePermission;
use App\Models\UM\Role;
use Illuminate\Http\Request;

class PermissionServices
{

    public function index()
    {
        $allPermissions = Permission::all();

        return response()->json(['data' => PermissionResponse::collection($allPermissions)]);
    }

    public function store($request)
    {

        $role = Role::where('id', $request->role)->orWhere('name', $request->role)->first();
        $rolePermission = RolePermission::create(['json' => json_encode($request->privileges, true), 'role_id' => $role->id]);

        if ($rolePermission) {
            return response()->json(['message' => 'created successfully'], 200);
        }
        return response()->json(['error' => 'system error'], 500);
    }


    public function show( $request ,$id)
    {
        $request->validate([$id=>'exists:role_permissions,role_id']);

        $Permissions = RolePermission::select(['json as privilege'])->where('role_id', $id)->get();
        if (count($Permissions)!= 0 ) {
        foreach ($Permissions as $rolesPrivilege) {
            $rolesPrivilege->privilege = json_decode($rolesPrivilege->privilege);
        }
        return response()->json(['data' => $Permissions], 200);
    }
    else{
        return response()->json(['data' => 'this role do not have privileges'], 404);
    }
    }



    public function update($request)
    {
    // dd($request->all());
        $Permission = RolePermission::where('role_id', $request->role_id)->first();
        // dd($Permission);
        $rolePermission = $Permission->update(['json' => json_encode($request->privileges,true) ?? $Permission->json,'role_id'=>$request->id ?? $Permission->role_id]);

        if ($rolePermission) {
            return response()->json(['message' => 'updated successfully'], 200);
        }
        return response()->json(['error' => 'system error'], 500);
    }




    public function delete($id)
    {
        $Permissions = RolePermission::find($id);

        $deleted = $Permissions->delete();
        if ($deleted) {
            return response()->json(['message' => 'deleted successfully'], 301);
        }
        return response()->json(['error' => 'system error'], 500);
    }

    // public function restoreById($id)
    // {
    //     $restore = RolePermission::where('id', $id)->withTrashed()->restore();
    //     if ($restore) {
    //         return response()->json(['message' => 'restored successfully'], 200);
    //     }
    //     return response()->json(['error' => 'system error'], 500);
    // }
}
