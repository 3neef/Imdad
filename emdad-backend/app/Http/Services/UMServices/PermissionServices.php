<?php

namespace App\Http\Services\UMServices;

use App\Http\Resources\UMResources\Permission\PermissionResponse;
use App\Models\UM\Permission;
use App\Models\UM\RolePermission;
use App\Models\UM\Role;



class PermissionServices
{
    public function create($request)
    {

        $role = Role::where('id', $request->role)->orWhere('name', $request->role)->first();

        $rolePermission = RolePermission::create(['json' => json_encode($request->privileges, true), 'role_id' => $role->id]);

        if ($rolePermission) {
            return response()->json(['message' => 'created successfully'], 200);
        }
        return response()->json(['error' => 'system error'], 500);
    }


    public function update($request)
    {
        $Permission = RolePermission::where('role_id', $request->id)->first();
        
        $rolePermission = $Permission->update(['json' => json_encode($request->privileges), true]);

        if ($rolePermission) {
            return response()->json(['message' => 'updated successfully'], 200);
        }
        return response()->json(['error' => 'system error'], 500);
    }

    public function showAll()
    {
        $allPermissions = Permission::all();
        return response()->json(['data' => PermissionResponse::collection($allPermissions)]);
    }

    public function showById($id)
    {
        $Permissions = RolePermission::select(['json as privilege'])->where('role_id', $id)->get();
        if (empty($Permissions)) {
            return response()->json(['data' => 'this role do not have privileges'], 200);
        }
        foreach ($Permissions as $rolesPrivilege) {
            $rolesPrivilege->privilege = json_decode($rolesPrivilege->privilege);
        }
        return response()->json(['data' => $Permissions], 200);
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

    public function restoreById($id)
    {
        $restore = RolePermission::where('id', $id)->withTrashed()->restore();
        if ($restore) {
            return response()->json(['message' => 'restored successfully'], 200);
        }
        return response()->json(['error' => 'system error'], 500);
    }
}
