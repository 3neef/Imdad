<?php

namespace App\Http\Services\UMServices;

use App\Http\Resources\UMResources\Role\RoleResponse;
use App\Models\UM\Role;


class RoleServices
{

    public function create($request)
    {
        $role = Role::create($request);
        if ($role) {
            return response()->json(['message' => 'created successfully'], 200);
        }
        return response()->json(['error' => 'system error'], 500);
    }

    public function update($request)
    {
        $role = Role::findOrFail($request->id);
        $result = $role->update(['name' => $request->name, 'type' => $request->type]);
        if ($result) {
            return response()->json(['message' => 'updated successfully'], 200);
        }
        return response()->json(['error' => 'system error'], 500);
    }

    public function showAll()
    {
        $roles = Role::all();
        return response()->json(['data' => RoleResponse::collection($roles)]);
    }

    public function showById($id)
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

    public function showByType($type)
    {
        $roles = Role::where('type', '=', $type)->get();
        if (!$roles->isEmpty()) {
            return response()->json(['data' => RoleResponse::collection($roles)], 200);
        } else {
            return response()->json(['message' => 'not found any role by this type -> ' . $type . ''], 404);
        }
        return response()->json(['error' => 'system error'], 500);
    }
}
