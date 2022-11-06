<?php

namespace App\Http\Controllers\UMController;

use App\Http\Controllers\Controller;
use App\Http\Requests\UMRequests\Permission\GetPermissionRequest;
use App\Http\Requests\UMRequests\Permission\CreatePermissionRequest;
use App\Http\Requests\UMRequests\Permission\UpdatePermissionRequest;
use App\Http\Requests\UMRequests\Permission\RestorePermissionRequest;
use App\Http\Services\UMServices\PermissionServices;

class PermissionsController extends Controller
{

    protected PermissionServices $PermissionService;

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
       /**
        * @OA\Post(
        * path="/api/v1_0/permissions/save",
        * operationId="savePermissionToRole",
        * tags={"permission"},
        * summary="save permisssion",
        * description="save permission to role Here",
        *     @OA\RequestBody(
        *         @OA\JsonContent(),
        *         @OA\MediaType(
        *            mediaType="multipart/form-data",
        *            @OA\Schema(
        *               type="object",
        *               required={"role", "privileges"},
        *               @OA\Property(property="role", type="integer,string"),
        *               @OA\Property(property="privileges", type="array")
        *            ),
        *        ),
        *    ),
        *      @OA\Response(
        *          response=200,
        *          description="created or updated permission",
        *          @OA\JsonContent(),
        *          @OA\MediaType(
        *            mediaType="multipart/form-data",
        *            @OA\Schema(
        *               type="object",
        *               @OA\Property(property="message", type="string"),
        *            ),
        *        ),
        *       ),
        *      @OA\Response(
        *          response=422,
        *          description="Unprocessable Entity",
        *          @OA\JsonContent()
        *       ),
        *      @OA\Response(response=400, description="Bad request"),
        *      @OA\Response(response=404, description="Resource Not Found"),
        * )
        */
    public function savePermission(CreatePermissionRequest $request) {
        return $this->PermissionService->createOrUpdate($request);
    }
       /**
        * @OA\get(
        * path="/api/v1_0/permissions/getAll",
        * operationId="getAllPermissions",
        * tags={"permission"},
        * summary="get permisssions",
        * description="get all permisssions Here",
        *      @OA\Response(
        *          response=200,
        *          description="get all permissions",
        *          @OA\JsonContent(),
        *          @OA\MediaType(
        *            mediaType="multipart/form-data",
        *            @OA\Schema(
        *               type="array",
        *            ),
        *        ),
        *       ),
        *      @OA\Response(
        *          response=422,
        *          description="Unprocessable Entity",
        *          @OA\JsonContent()
        *       ),
        *      @OA\Response(response=400, description="Bad request"),
        *      @OA\Response(response=404, description="Resource Not Found"),
        * )
        */
    public function getAllPermissions() {
        return $this->PermissionService->showAll();
    }
       /**
        * @OA\get(
        * path="/api/v1_0/permissions/getById/{id}",
        * operationId="get permission",
        * tags={"permission"},
        * summary="get permisssion",
        * description="get permission by id Here",
        *      @OA\Response(
        *          response=200,
        *          description="get permission",
        *          @OA\JsonContent(),
        *          @OA\MediaType(
        *            mediaType="multipart/form-data",
        *            @OA\Schema(
        *               type="object",
        *               @OA\Property(property="privileges", type="array"),
        *            ),
        *        ),
        *       ),
        *      @OA\Response(
        *          response=422,
        *          description="Unprocessable Entity",
        *          @OA\JsonContent()
        *       ),
        *      @OA\Response(response=400, description="Bad request"),
        *      @OA\Response(response=404, description="Resource Not Found"),
        * )
        */
    public function getPermissionByRoleId( $id ,GetPermissionRequest $request) {
        return $this->PermissionService->showById($id);
    }
       /**
        * @OA\put(
        * path="/api/v1_0/permissions/update",
        * operationId="update permission to specific role",
        * tags={"permission"},
        * summary="update permisssion",
        * description="update permission to specific role Here",
        *      @OA\JsonContent(),
        *      @OA\MediaType(
        *            mediaType="multipart/form-data",
        *            @OA\Schema(
        *               type="object",
        *               required={"id","privileges"},
        *               @OA\Property(property="id", type="integer"),
        *               @OA\Property(property="privileges", type="array"),
        *            ),
        *        ),
        *      @OA\Response(
        *          response=200,
        *          description="update permission",
        *          @OA\JsonContent(),
        *          @OA\MediaType(
        *            mediaType="multipart/form-data",
        *            @OA\Schema(
        *               type="object",
        *               @OA\Property(property="message", type="string"),
        *            ),
        *        ),
        *       ),
        *      @OA\Response(
        *          response=422,
        *          description="Unprocessable Entity",
        *          @OA\JsonContent()
        *       ),
        *      @OA\Response(response=400, description="Bad request"),
        *      @OA\Response(response=404, description="Resource Not Found"),
        * )
        */
    public function updatePermission(UpdatePermissionRequest $request){
        return $this->PermissionService->update(json_encode( $request ->json()->get( 'privileges' ), true ),$request ->get('id'));
    }
       /**
        * @OA\delete(
        * path="/api/v1_0/permissions/delete/{id}",
        * operationId="delete permission to specific role",
        * tags={"permission"},
        * summary="update permisssion",
        * description="update permission to specific role Here",
        *      @OA\Response(
        *          response=200,
        *          description="delete permission",
        *          @OA\JsonContent(),
        *          @OA\MediaType(
        *            mediaType="multipart/form-data",
        *            @OA\Schema(
        *               type="object",
        *               @OA\Property(property="message", type="string"),
        *            ),
        *        ),
        *       ),
        *      @OA\Response(
        *          response=422,
        *          description="Unprocessable Entity",
        *          @OA\JsonContent()
        *       ),
        *      @OA\Response(response=400, description="Bad request"),
        *      @OA\Response(response=404, description="Resource Not Found"),
        * )
        */
    public function deletePermission($id ,GetPermissionRequest $request)
    {
        return $this->PermissionService->delete($id);
    }
       /**
        * @OA\delete(
        * path="/api/v1_0/permissions/restore/{id}",
        * operationId="restore permission to specific role",
        * tags={"permission"},
        * summary="restore permisssion",
        * description="restore permission to specific role Here",
        *      @OA\Response(
        *          response=200,
        *          description="restore permission",
        *          @OA\JsonContent(),
        *          @OA\MediaType(
        *            mediaType="multipart/form-data",
        *            @OA\Schema(
        *               type="object",
        *               @OA\Property(property="message", type="string"),
        *            ),
        *        ),
        *       ),
        *      @OA\Response(
        *          response=422,
        *          description="Unprocessable Entity",
        *          @OA\JsonContent()
        *       ),
        *      @OA\Response(response=400, description="Bad request"),
        *      @OA\Response(response=404, description="Resource Not Found"),
        * )
        */
    public function restoreById($id,RestorePermissionRequest $request){
        return $this->PermissionService->restoreById($id);
    }
}
