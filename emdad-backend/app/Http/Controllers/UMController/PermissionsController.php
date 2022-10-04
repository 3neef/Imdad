<?php

namespace App\Http\Controllers\UMController;

use App\Http\Controllers\Controller;
use App\Http\Services\UMServices\PermissionServices;
use App\Http\Requests\UMRequests\Permission\GetPermissionRequest;
use App\Http\Requests\UMRequests\Permission\CreatePermissionRequest;
use App\Http\Requests\UMRequests\Permission\UpdatePermissionRequest;
use App\Http\Requests\UMRequests\Permission\RestorePermissionRequest;

class PermissionsController extends Controller
{

    protected $PermissionService;
 
    /**
     * Create a new controller instance.
     *
     * @param  App\Http\Services\UMServices\PermissionServices  $PermissionService
     * @return void
     */
    public function __construct(PermissionServices $PermissionService)
    {
        $this->PermissionService = $PermissionService;
    }

    public function savePermission( CreatePermissionRequest $request) {
        return $this->PermissionService->createOrUpdate($request);
    }

    public function getAllPermissions() {
        return $this->PermissionService->showAll();
    }

    public function getPermissionByRoleId( $id ,GetPermissionRequest $request) {
        return $this->PermissionService->showById($id);
    }

    public function updatePermission(UpdatePermissionRequest $request){
        return $this->PermissionService->update(json_encode( $request ->json()->get( 'privileges' ), true ),$request ->get('id'));
    }
    
    public function deletePermission($id ,GetPermissionRequest $request)
    {
        return $this->PermissionService->delete($id);
    }

    public function restoreById($id,RestorePermissionRequest $request){
        return $this->PermissionService->restoreById($id);
    }
}
