<?php

namespace App\Http\Controllers\UMController;

use App\Http\Controllers\Controller;
use App\Http\Requests\UMRequests\Permission\GetPermissionRequest;
use App\Http\Requests\UMRequests\Permission\CreatePermissionRequest;
use App\Http\Requests\UMRequests\Permission\UpdatePermissionRequest;
use App\Http\Requests\UMRequests\Permission\RestorePermissionRequest;
use App\Http\Services\UMServices\PermissionServices;
use Illuminate\Http\Request;

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
        * path="/api/v1_0/permissions",
        * operationId="savePermissionToRole",
        * tags={"Roles and Permissions"},
        * summary="save permisssion",
        * description="save permission to role Here",
*     @OA\Parameter(
     *         name="x-authorization",
     *         in="header",
     *         description="Set x-authorization",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *         *     @OA\Parameter(
     *         name="token",
     *         in="header",
     *         description="Set user authentication token",
     *         @OA\Schema(
     *             type="beraer"
     *         )
     *     ),
        *     @OA\RequestBody(
        *         @OA\JsonContent(),
        *         @OA\MediaType(
        *            mediaType="multipart/form-data",
        *            @OA\Schema(
        *               type="object",
        *               required={"name", "label","category","description"},
        *               @OA\Property(property="name", type="string"),
        *               @OA\Property(property="label", type="string"),
        *               @OA\Property(property="category", type="string"),
        *               @OA\Property(property="category", type="string"),
        *               @OA\Property(property="description", type="string"),
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
        *               @OA\Property(property="message", type="string")
        *            ),
        *        ),
        *       ),
        *      @OA\Response(
        *          response=422,
        *          description="Unprocessable Entity"
        *       ),
        *      @OA\Response(response=400, description="Bad request"),
        *      @OA\Response(response=404, description="Resource Not Found")
        * )
        */
    public function store(CreatePermissionRequest $request) {
        return $this->PermissionService->store($request);
    }
       /**
        * @OA\get(
        * path="/api/v1_0/permissions/getAll",
        * operationId="getAllPermissions",
        * tags={"UM & Permissions"},
        * summary="get permisssions",
        * description="get all permisssions Here",
*     @OA\Parameter(
     *         name="x-authorization",
     *         in="header",
     *         description="Set x-authorization",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *         *     @OA\Parameter(
     *         name="token",
     *         in="header",
     *         description="Set user authentication token",
     *         @OA\Schema(
     *             type="beraer"
     *         )
     *     ),
        *      @OA\Response(
        *          response=200,
        *          description="get all permissions",
        *          @OA\JsonContent(),
        *          @OA\MediaType(
        *            mediaType="multipart/form-data",
        *            @OA\Schema(
        *               type="array",@OA\Items(type = "string")
        *            ),
        *        ),
        *       ),
        *      @OA\Response(
        *          response=422,
        *          description="Unprocessable Entity",
        *       ),
        *      @OA\Response(response=400, description="Bad request"),
        *      @OA\Response(response=404, description="Resource Not Found"),
        * )
        */
    public function index() {
        return $this->PermissionService->index();
    }
       /**
        * @OA\get(
        * path="/api/v1_0/permissions/getById/{id}",
        * operationId="get-permissions",
        * tags={"UM & Permissions"},
        * summary="get permisssion",
        * description="get permission by id Here",
*     @OA\Parameter(
     *         name="x-authorization",
     *         in="header",
     *         description="Set x-authorization",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *         *     @OA\Parameter(
     *         name="token",
     *         in="header",
     *         description="Set user authentication token",
     *         @OA\Schema(
     *             type="beraer"
     *         )
     *     ),
        *      @OA\Response(
        *          response=200,
        *          description="get permission",
        *          @OA\JsonContent(),
        *          @OA\MediaType(
        *            mediaType="multipart/form-data",
        *            @OA\Schema(
        *               type="object",
        *               @OA\Property(property="privileges", type="array",@OA\Items(type = "string")),
        *            ),
        *        ),
        *       ),
        *      @OA\Response(
        *          response=422,
        *          description="Unprocessable Entity",
        *       ),
        *      @OA\Response(response=400, description="Bad request"),
        *      @OA\Response(response=404, description="Resource Not Found"),
        * )
        */
    public function show($id) {
        return $this->PermissionService->show($id);
    }
       /**
        * @OA\Put(
        * path="/api/v1_0/permissions",
        * operationId="updatePermissionToSpecificRole",
        * tags={"Roles and Permissions"},
        * summary="update permisssion",
        * description="update permission to specific role Here",
*     @OA\Parameter(
     *         name="x-authorization",
     *         in="header",
     *         description="Set x-authorization",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *         *     @OA\Parameter(
     *         name="token",
     *         in="header",
     *         description="Set user authentication token",
     *         @OA\Schema(
     *             type="beraer"
     *         )
     *     ),
        *     @OA\RequestBody(
        *        @OA\JsonContent(),
        *        @OA\MediaType(
        *            mediaType="multipart/form-data",
        *            @OA\Schema(
        *               type="object",
        *               required={"id","privileges"},
        *               required={"name", "label","category","description"},
        *               @OA\Property(property="name", type="string"),
        *               @OA\Property(property="label", type="string"),
        *               @OA\Property(property="category", type="string"),
        *               @OA\Property(property="category", type="string"),
        *               @OA\Property(property="description", type="string"),
        *            ),
        *          ),
        *       ),
        *      @OA\Response(
        *          response=200,
        *          description="update permission",
        *          @OA\JsonContent(),
        *          @OA\MediaType(
        *            mediaType="multipart/form-data",
        *            @OA\Schema(
        *               type="object",
        *               @OA\Property(property="message", type="string")
        *            ),
        *        ),
        *       ),
        *      @OA\Response(
        *          response=422,
        *          description="Unprocessable Entity"
        *       ),
        *      @OA\Response(response=400, description="Bad request"),
        *      @OA\Response(response=404, description="Resource Not Found")
        * )
        */
    public function update(UpdatePermissionRequest $request,$id){
        return $this->PermissionService->update($request,$id);
    }
       /**
        * @OA\delete(
        * path="/api/v1_0/permissions/delete/{id}",
        * operationId="delete-permission-from-specific-role",
        * tags={"UM & Permissions"},
        * summary="update permisssion",
        * description="update permission to specific role Here",
*     @OA\Parameter(
     *         name="x-authorization",
     *         in="header",
     *         description="Set x-authorization",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *         *     @OA\Parameter(
     *         name="token",
     *         in="header",
     *         description="Set user authentication token",
     *         @OA\Schema(
     *             type="beraer"
     *         )
     *     ),
        *      @OA\Response(
        *          response=200,
        *          description="delete permission",
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
        *       ),
        *      @OA\Response(response=400, description="Bad request"),
        *      @OA\Response(response=404, description="Resource Not Found"),
        * )
        */
    public function destroy($id)
    {
        return $this->PermissionService->delete($id);
    }
       /**
        * @OA\delete(
        * path="/api/v1_0/permissions/restore/{id}",
        * operationId="restore-permission-to-specific-role",
        * tags={"UM & Permissions"},
        * summary="restore permisssion",
        * description="restore permission to specific role Here",
*     @OA\Parameter(
     *         name="x-authorization",
     *         in="header",
     *         description="Set x-authorization",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *         *     @OA\Parameter(
     *         name="token",
     *         in="header",
     *         description="Set user authentication token",
     *         @OA\Schema(
     *             type="beraer"
     *         )
     *     ),
        *      @OA\Response(
        *          response=200,
        *          description="restore permission",
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
        *       ),
        *      @OA\Response(response=400, description="Bad request"),
        *      @OA\Response(response=404, description="Resource Not Found"),
        * )
        */
    public function restoreById( $permissionId){
        return $this->PermissionService->restoreById($permissionId);
    }
}
