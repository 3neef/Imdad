<?php

namespace App\Http\Controllers\UMController;

use App\Http\Controllers\Controller;
use App\Http\Services\UMServices\RoleServices;
use App\Http\Requests\UMRequests\Role\GetRoleRequest;
use App\Http\Requests\UMRequests\Role\CreateRoleRequest;
use App\Http\Requests\UMRequests\Role\GetRoleByIdRequest;
use App\Http\Requests\UMRequests\Role\RestoreRoleByIdRequest;

class RoleController extends Controller
{
    protected RoleServices $roleServices;
 
    /**
     * Create a new controller instance.
     *
     * @param  App\Http\Services\UMServices\RoleServices  $roleServices
     * @return void
     */
    public function __construct(RoleServices $roleServices)
    {
        $this->roleServices = $roleServices;
    }

    public function saveRole(CreateRoleRequest $request)
    {
        return $this->roleServices->create($request);
    }

    public function updateRole(GetRoleRequest $request)
    {
        return $this->roleServices->update($request);
    }

    public function deleteRole(GetRoleByIdRequest $request,$id)
    {
        return $this->roleServices->delete($id);
    }

    public function getAllRoles()
    {
        return $this->roleServices->showAll();
    }

    public function getByRoleId(GetRoleByIdRequest $request,$id)
    {
        return $this->roleServices->showById($id);
    }

    public function restoreByRoleId($id,RestoreRoleByIdRequest $request)
    {
        return $this->roleServices->restoreById($id);
    }

    public function getByType(GetRoleByIdRequest $request,$type)
    {
        return $this->roleServices->showByType($type);
    }
}
