<?php

namespace App\Http\Controllers\UMController;
use App\Http\Resources\UMResources\Role\RoleResponse;

use App\Http\Controllers\Controller;
use App\Http\Services\UMServices\RoleServices;
use App\Http\Requests\UMRequests\Role\GetRoleRequest;
use App\Http\Requests\UMRequests\Role\CreateRoleRequest;
use App\Http\Requests\UMRequests\Role\GetRoleByIdRequest;
use App\Http\Requests\UMRequests\Role\RestoreRoleByIdRequest;
use App\Models\UM\Role;
use Illuminate\Http\Request;

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
        * @OA\get(
        * path="/api/v1_0/roles/getAll",
        * operationId="getAllRoles",
        * tags={"Roles and Permissions"},
        * summary="get roles",
        * description="get all roles Here",
*     @OA\Parameter(
     *         name="x-authorization",
     *         in="header",
     *         description="Set x-authorization",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
        *      @OA\Response(
        *          response=200,
        *          description="get all roles",
        *          @OA\JsonContent(),
        *          @OA\MediaType(
        *            mediaType="multipart/form-data",
        *            @OA\Schema(
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
        public function index()
        {

            return $this->roleServices->showAll();
        }

       /**
        * @OA\post(
        * path="/api/v1_0/roles/save",
        * operationId="saveNewRole",
        * tags={"Roles and Permissions"},
        * summary="create role",
        * description="create new role Here",
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
        *               @OA\Property(property="message", type="string"),
        *               @OA\Property(property="data", type="string")

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
    public function store(CreateRoleRequest $request)
    {
        return $this->roleServices->store($request);
    }
       /**
        * @OA\put(
        * path="/api/v1_0/roles/update",
        * operationId="updateRole",
        * tags={"Roles and Permissions"},
        * summary="update role",
        * description="update role Here",
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
    public function update(GetRoleRequest $request,$id)
    {
        return $this->roleServices->update($request,$id);
    }
       /**
        * @OA\delete(
        * path="/api/v1_0/roles/delete/{id}",
        * operationId="deleteRole",
        * tags={"Roles and Permissions"},
        * summary="delete roles",
        * description="delete roles Here",
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
        *          description="deleted role successfully",
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
        *      @OA\Response(response=404, description="Resource Not Found"),
        * )
        */
    public function destroy($id)
    {
        return $this->roleServices->delete($id);
    }

       /**
        * @OA\get(
        * path="/api/v1_0/roles/getByRoleId/{id}",
        * operationId="getRole",
        * tags={"Roles and Permissions"},
        * summary="get role by id",
        * description="get role Here",
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
    public function show($id)
    {
        return $this->roleServices->showById($id);
    }
       /**
        * @OA\get(
        * path="/api/v1_0/roles-for-reg",
        * operationId="getRoleRegister",
        * tags={"Roles and Permissions"},
        * summary="get roles register",
        * description="get roles register Here",
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
     *    @OA\Response(
     *         response=200,
     *         description="",
     *         @OA\JsonContent(
     *  @OA\Property(property="success", type="boolean"),
     *  @OA\Property(property="message", type="string"),
     *         @OA\Property(property="data", type="string"
     *          , example="[{'id': 1, 'name': 'GM'}]")
     *          ),
     *       ),
        *      @OA\Response(
        *          response=422,
        *          description="Unprocessable Entity"
        *       ),
        *      @OA\Response(response=400, description="Bad request"),
        *      @OA\Response(response=404, description="Resource Not Found"),
        * )
        */
    public function getRolesForReg(Request $request)
    {
        return response()->json(["success"=>true,"data"=>RoleResponse::collection(Role::where("for_reg",1)->get())],200);
    }
        /**
        * @OA\put(
        * path="/api/v1_0/roles/restore/{id}",
        * operationId="restoreRole",
        * tags={"Roles and Permissions"},
        * summary="restore role by id",
        * description="restore role Here",
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
        *          description="restore role successfully",
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
        *      @OA\Response(response=404, description="Resource Not Found"),
        * )
        */
    public function restoreByRoleId($id)
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
        *          description="get all roles by type",
        *          @OA\JsonContent(),
        *          @OA\MediaType(
        *            mediaType="multipart/form-data",
        *            @OA\Schema(type="array",@OA\Items(type = "object")
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
