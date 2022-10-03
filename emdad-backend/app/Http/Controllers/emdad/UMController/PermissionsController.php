<?php

namespace App\Http\Controllers\emdad\UMController;

use App\Http\Controllers\Controller;
use App\Http\Services\UMServices\PermissionServices;
use App\Http\Requests\UMRequests\Permission\GetPermissionRequest;
use App\Http\Requests\UMRequests\Permission\CreatePermissionRequest;
use App\Http\Requests\UMRequests\Permission\UpdatePermissionRequest;
use App\Http\Requests\UMRequests\Permission\RestorePermissionRequest;

class PermissionsController extends Controller
{
    public function savePermission( CreatePermissionRequest $request, PermissionServices $PermissionService) {
        return $PermissionService->createOrUpdate($request);
    }

    public function getAllPermissions(PermissionServices $PermissionService) {
        return $PermissionService->showAll();
    }

    public function getPermissionByRoleId( $id ,GetPermissionRequest $request,PermissionServices $PermissionService) {
        return $PermissionService->showById($id);
    }

    public function updatePermission(UpdatePermissionRequest $request,PermissionServices $PermissionService){
        return $PermissionService->update(json_encode( $request ->json()->get( 'privileges' ), true ),$request ->get('id'));
    }
    
    public function deletePermission($id ,GetPermissionRequest $request,PermissionServices $PermissionService)
    {
        return $PermissionService->delete($id);
    }

    public function restoreById($id,RestorePermissionRequest $request,PermissionServices $PermissionService){
        return $PermissionService->restoreById($id);
    }
}
