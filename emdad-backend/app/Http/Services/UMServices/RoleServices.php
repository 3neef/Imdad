<?php

namespace App\Http\Services\UMServices;

use App\Http\Collections\RolesCollection;
use App\Http\Resources\UMResources\Role\RoleResponse;
use App\Models\UM\Role;


class RoleServices
{

    public function store($request)
    {
        $role = Role::create($request->all());
        if ($role) {
            return response()->json(['message' => 'created successfully'], 200);
        }
        return response()->json(['error' => 'system error'], 500);
    }

    public function update($request,$id)
    {
        $role = Role::where('id',$id)->first();
        if($role==null)
        {
        return response()->json(['error' => 'No data Founded', 'data'=>[]], 404);

        }else{
            $result = $role->update($request->all());
                return response()->json(['message' => 'updated successfully'], 200);
        }

    }

    public function index()
    {

        return RolesCollection::collection();
    }

    public function show($id)
    {
        $role = Role::where('id', $id)->first();

        return response()->json(['data' => new RoleResponse($role)], 200);
    }

    public function delete($id)
    {
        $role = Role::find($id);

        $deleted = $role->delete();

        if ($deleted) {
            return response()->json(['message' => 'deleted successfully'], 301);
        }
        return response()->json(['error' => 'system error'], 500);
    }

    public function restoreById($id)
    {
        $restore = Role::where('id', $id)->withTrashed()->restore();
        if ($restore) {
            return response()->json(['message' => 'restored successfully'], 200);
        }
        return response()->json(['error' => 'system error'], 500);
    }


}
