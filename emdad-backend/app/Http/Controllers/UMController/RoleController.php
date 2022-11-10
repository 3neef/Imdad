<?php

namespace App\Http\Controllers\UMController;
use App\Http\Resources\UMResources\Role\RoleResponse;

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
       /**
        * @OA\post(
        * path="/api/v1_0/roles/save",
        * operationId="saveNewRole",
        * tags={"Roles and Permissions"},
        * summary="create role",
        * description="create new role Here",
        *     @OA\RequestBody(
        *         @OA\JsonContent(),
        *         @OA\MediaType(
        *            mediaType="multipart/form-data",
        *            @OA\Schema(
        *               type="object",
        *               required={"name", "type"},
        *               @OA\Property(property="name", type="string"),
        *               @OA\Property(property="type",  type = "integer")
        *            ),
        *        ),
        *    ),
        *      @OA\Response(
        *          response=200,
        *          description="created role successfully",
        *          @OA\JsonContent(),
        *          @OA\MediaType(
        *            mediaType="multipart/form-data",
        *            @OA\Schema(
        *               type="object",
        *               @OA\Property(property="massege", type="string"),
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
    public function saveRole(CreateRoleRequest $request)
    {
        return $this->roleServices->create($request);
    }
       /**
        * @OA\put(
        * path="/api/v1_0/roles/update",
        * operationId="updateRole",
        * tags={"Roles and Permissions"},
        * summary="update role",
        * description="update role Here",
        *     @OA\RequestBody(
        *         @OA\JsonContent(),
        *         @OA\MediaType(
        *            mediaType="multipart/form-data",
        *            @OA\Schema(
        *               type="object",
        *               required={"id"},
        *               @OA\Property(property="id", type="integer"),
        *               @OA\Property(property="name", type="string"),
        *               @OA\Property(property="type",  type = "integer")
        *            ),
        *        ),
        *    ),
        *      @OA\Response(
        *          response=200,
        *          description="updated role successfully",
        *          @OA\JsonContent(),
        *          @OA\MediaType(
        *            mediaType="multipart/form-data",
        *            @OA\Schema(
        *               type="object",
        *               @OA\Property(property="massege", type="string"),
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
    public function updateRole(GetRoleRequest $request)
    {
        return $this->roleServices->update($request);
    }
       /**
        * @OA\delete(
        * path="/api/v1_0/roles/delete/{id}",
        * operationId="deleteRole",
        * tags={"Roles and Permissions"},
        * summary="delete roles",
        * description="delete roles Here",
        *      @OA\Response(
        *          response=200,
        *          description="deleted role successfully",
        *          @OA\JsonContent(),
        *          @OA\MediaType(
        *            mediaType="multipart/form-data",
        *            @OA\Schema(
        *               type="object",
        *               @OA\Property(property="massege", type="string")
        *            ),
        *        ),
        *       ),
        *      @OA\Response(
        *          response=422,
        *          description="Unprocessable Entity"
        *       ),
        *      @OA\Response(response=400, description="Bad request"),
        *      @OA\Response(response=404, description="Resource Not Found"),
        * )
        */
    public function deleteRole(GetRoleByIdRequest $request,$id)
    {
        return $this->roleServices->delete($id);
    }
       /**
        * @OA\get(
        * path="/api/v1_0/roles/getAll",
        * operationId="getAllRoles",
        * tags={"Roles and Permissions"},
        * summary="get roles",
        * description="get all roles Here",
        *      @OA\Response(
        *          response=200,
        *          description="get all roles",
        *          @OA\JsonContent(),
        *          @OA\MediaType(
        *            mediaType="multipart/form-data",
        *            @OA\Schema(
        *               type="array",@OA\Items(type = "object")
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
    public function getAllRoles()
    {
        return $this->roleServices->showAll();
    }
       /**
        * @OA\get(
        * path="/api/v1_0/roles/getByRoleId/{id}",
        * operationId="getRole",
        * tags={"Roles and Permissions"},
        * summary="get role by id",
        * description="get role Here",
        *      @OA\Response(
        *          response=200,
        *          description="get role",
        *          @OA\JsonContent(),
        *          @OA\MediaType(
        *            mediaType="multipart/form-data",
        *            @OA\Schema(
        *               type="object"
        *            ),
        *        ),
        *       ),
        *      @OA\Response(
        *          response=422,
        *          description="Unprocessable Entity"
        *       ),
        *      @OA\Response(response=400, description="Bad request"),
        *      @OA\Response(response=404, description="Resource Not Found"),
        * )
        */
    public function getByRoleId(GetRoleByIdRequest $request,$id)
    {
        return $this->roleServices->showById($id);
    }

    public function getRolesForReg(Request $request)
    {
        return response()->json(["success"=>true,"data"=>RoleResponse::collection(Roles::where("for_req",1)->get)],200);
    }
        /**
        * @OA\put(
        * path="/api/v1_0/roles/restore/{id}",
        * operationId="restoreRole",
        * tags={"Roles and Permissions"},
        * summary="restore role by id",
        * description="restore role Here",
        *      @OA\Response(
        *          response=200,
        *          description="restore role successfully",
        *          @OA\JsonContent(),
        *          @OA\MediaType(
        *            mediaType="multipart/form-data",
        *            @OA\Schema(
        *               type="object",
        *               @OA\Property(property="massege", type="string")
        *            ),
        *        ),
        *       ),
        *      @OA\Response(
        *          response=422,
        *          description="Unprocessable Entity"
        *       ),
        *      @OA\Response(response=400, description="Bad request"),
        *      @OA\Response(response=404, description="Resource Not Found"),
        * )
        */
    public function restoreByRoleId($id,RestoreRoleByIdRequest $request)
    {
        return $this->roleServices->restoreById($id);
    }
       /**
        * @OA\get(
        * path="/api/v1_0/roles/getByType/{type}",
        * operationId="getAllRolesByType",
        * tags={"Roles and Permissions"},
        * summary="get roles by type",
        * description="get all roles by type",
        *      @OA\Response(
        *          response=200,
        *          description="get all roles by type",
        *          @OA\JsonContent(),
        *          @OA\MediaType(
        *            mediaType="multipart/form-data",
        *            @OA\Schema(
        *               type="array",@OA\Items(type = "object")
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
    public function getByType(GetRoleByIdRequest $request,$type)
    {
        return $this->roleServices->showByType($type);
    }
}
