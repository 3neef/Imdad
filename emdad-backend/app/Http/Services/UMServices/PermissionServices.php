<?php

namespace App\Http\Services\UMServices;

use App\Http\Collections\PermissionsCollection;
use App\Http\Resources\UMResources\Permission\PermissionResponse;
use App\Models\UM\Permission;
use App\Models\UM\RolePermission;
use App\Models\UM\Role;
use Illuminate\Http\Request;

class PermissionServices
{

    public function index()
    {
        return PermissionsCollection::collection();
    }

    public function store($request)
    {
        $Permission = Permission::create($request->all());

        if ($Permission) {
            return response()->json(['message' => 'created successfully'], 200);
        }
        return response()->json(['error' => 'system error'], 500);
    }


    public function show($id)
    {

        $Permissions = Permission::where('id', $id)->first();
        if ($Permissions) {
            return response()->json(['data' => $Permissions, 'message' => 'success'], 200);
        }
        return response()->json(['message' => 'permissions not found ', 'data' => []], 404);
    }



    public function update($request, $id)
    {

        $Permission = Permission::where('id', $id)->first();
        // dd($Permission);
        $Permission = $Permission->update($request->all());

        if ($Permission) {
            return response()->json(['message' => 'updated successfully'], 200);
        }
        return response()->json(['error' => 'system error'], 500);
    }




    public function delete($id)
    {
        $Permissions = Permission::find($id)->first();

        $deleted = $Permissions->delete();
        if ($deleted) {
            return response()->json(['message' => 'deleted successfully'], 301);
        }
        return response()->json(['error' => 'system error'], 500);
    }

    public function restoreById($permissionId)
    {
        $restore = Permission::where('id', $permissionId)->withTrashed()->restore();
        if ($restore) {
            return response()->json(['message' => 'restored successfully'], 200);
        }
        return response()->json(['error' => 'system error'], 500);
    }
}
