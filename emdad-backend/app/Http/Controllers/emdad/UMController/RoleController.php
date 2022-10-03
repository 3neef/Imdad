<?php

namespace App\Http\Controllers\emdad\UMController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\UMServices\RoleServices;
use App\Http\Requests\UMRequests\Role\GetRoleRequest;
use App\Http\Requests\UMRequests\Role\CreateRoleRequest;
use App\Http\Requests\UMRequests\Role\GetRoleByIdRequest;
use App\Http\Requests\UMRequests\Role\RestoreRoleByIdRequest;

class RoleController extends Controller
{
    public function saveRole(CreateRoleRequest $request,RoleServices $roleServices)
    {
        return $roleServices->create($request);
    }

    public function updateRole(GetRoleRequest $request ,RoleServices $roleServices)
    {
        return $roleServices->update($request);
    }

    public function deleteRole(GetRoleByIdRequest $request,$id,RoleServices $roleServices)
    {
        return $roleServices->delete($id);
    }

    public function getAllRoles(RoleServices $roleServices)
    {
        return $roleServices->showAll();
    }

    public function getByRoleId(GetRoleByIdRequest $request,$id,RoleServices $roleServices)
    {
        return $roleServices->showById($id);
    }

    public function restoreByRoleId($id,RestoreRoleByIdRequest $request,RoleServices $roleServices)
    {
        return $roleServices->restoreById($id);
    }
}
