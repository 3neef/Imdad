<?php

namespace App\Http\Controllers\User;

use App\Http\Collections\UserCollection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UMRequests\DeleteWarehouse;
use App\Http\Requests\UMRequests\DeleteWarehouseRequest;
use App\Http\Requests\UMRequests\UpdateUserWarehouseStatusRequest;
use App\Http\Requests\UMRequests\UpdateUserWharehouseStatus;
use App\Http\Requests\UMRequests\User\AssignRoleRequest;
use App\Http\Requests\UMRequests\User\DefaultCompanyRequest;
use App\Http\Requests\UMRequests\User\GetUserByIdRequest;
use App\Http\Requests\UMRequests\User\GetUserRequest;
use App\Http\Requests\UMRequests\User\RestoreUserByIdRequest;
use App\Http\Requests\UMRequests\User\StoreUserRequest;
use App\Http\Requests\UMRequests\User\UpdateRequest;
use App\Http\Requests\UMRequests\User\UserAvtivateRerquest;
use App\Http\Resources\UMResources\User\UserResponse;
use App\Http\Services\UMServices\UserServices;
use App\Models\User;

class UserController extends Controller
{
    public function index(Request $request)
    {
        return UserCollection::collection($request);
    }


    /**
     * @OA\Post(
     * path="/api/v1_0/users/register",
     * operationId="add-user",
     * tags={"UM & Permissions"},
     * summary="Register User",
     * description="Register User Here",
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
     *               required={"fullName","password","email","mobile","identityNumber","roleId","expireDate"},
     *               @OA\Property(property="fullName", type="string"),
     *               @OA\Property(property="expireDate", type="date"),
     *               @OA\Property(property="password", type="string"),
     *               @OA\Property(property="email", type="email"),
     *               @OA\Property(property="mobile", type="string"),
     *               @OA\Property(property="identityNumber", type="string"),
     *               @OA\Property(property="identityType", type="string"),
     *               @OA\Property(property="is_learning", type="boolean"),
     *               @OA\Property(property="manager_user_Id", type="integer")
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="User created successfully",
     *          @OA\JsonContent(),
     *          @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               @OA\Property(property="message", type="string"),
     *               @OA\Property(property="data", type="object")
     *            ),
     *          ),
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
    public function store(StoreUserRequest $request, UserServices $userServices)
    {
        return $userServices->create($request->validated());
    }

    /**
     * @OA\Get(
     * path="/api/v1_0/users/user-data",
     * operationId="get-user-data-by-token",
     * tags={"UM & Permissions"},
     * summary="Get user Info by token ",
     * description="Register User Here",
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
     *               @OA\Property(property="dataset[defalut_company]", type="string"),

     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(),
     *          @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               @OA\Property(property="message", type="string"),
     *               @OA\Property(property="data", type="object")
     *            ),
     *          ),
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
    public function getUserInfoByToken(Request $request)
    {
        ///TODO
        $user = auth()->user();

        if ($request->has('dataset') && is_array($request->dataset)) {
            if (
                in_array(
                    'default_company',
                    array_map('strtolower', $request->dataset)
                )
            ) {
            }
        }


        return response()->json(["status" => "success", "data" => new UserResponse($user)], 200);
    }

/**
     * @OA\put(
     * path="/api/v1_0/users/update-owner-user/{id}",
     * operationId="updateOwner",
     * tags={"UM & Permissions"},
     * summary="update owner user",
     * description="update update owner user Here",
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
     *               @OA\Property(property="fullName", type="string"),
     *               @OA\Property(property="password", type="string"),
     *               @OA\Property(property="identityNumber", type="string"),
     *               @OA\Property(property="email", type="email"),
     *               @OA\Property(property="mobile", type="string"),
     *               @OA\Property(property="roleId", type="integer"),
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="User updated successfully",
     *          @OA\JsonContent(),
     *          @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               @OA\Property(property="message", type="string"),
     *               @OA\Property(property="data", type = "object")
     *            ),
     *          ),
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



     public function UpdateOwnerUser(UpdateRequest $request, UserServices $userServices,$id)
     {
         // dd(e);
         return $userServices->update($request,$id);
     }


    /**
     * @OA\put(
     * path="/api/v1_0/users/update/{id}",
     * operationId="updateUser",
     * tags={"UM & Permissions"},
     * summary="update User",
     * description="update User Here",
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
     *               @OA\Property(property="fullName", type="string"),
     *               @OA\Property(property="password", type="string"),
     *               @OA\Property(property="email", type="email"),
     *               @OA\Property(property="mobile", type="string"),
     *               @OA\Property(property="roleId", type="integer"),
     *               @OA\Property(property="manager_user_Id", type="integer")
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="User updated successfully",
     *          @OA\JsonContent(),
     *          @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               @OA\Property(property="message", type="string"),
     *               @OA\Property(property="data", type = "object")
     *            ),
     *          ),
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
    public function update(UpdateRequest $request, UserServices $userServices,$id)
    {
        // dd(e);
        return $userServices->update($request,$id);
    }


    /**
     * @OA\put(
     * path="/api/v1_0/users/restore/{id}",
     * operationId="restoreUser",
     * tags={"UM & Permissions"},
     * summary="Restore User",
     * description="restore user here",
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
     *          description="User restored successfully",
     *          @OA\JsonContent()
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
    public function restoreUser(RestoreUserByIdRequest  $request, UserServices $userServices)
    {
        // dd('p');
        return $userServices->restoreById($request);
    }



    /**
     * @OA\delete(
     * path="/api/v1_0/users/destroy/{id}",
     * operationId="deleteUser",
     * tags={"UM & Permissions"},
     * summary="Delete User",
     * description="delete user here",
     *     @OA\Parameter(
     *         name="user_id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
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
     *            mediaType="application-json",
     *            @OA\Schema(
     *               type="object",
     *               @OA\Property(property="id", type="integer"),
     *               @OA\Property(property="param", type="boolean")
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=301,
     *          description="User deleted successfully",
     *          @OA\JsonContent()
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
    public function delete( GetUserRequest $id, UserServices $userServices)
    {
        return $userServices->delete($id);
    }



    /**
     * @OA\Put(
     * path="/api/v1_0/users/Activate",
     * operationId=" userActivate",
     * tags={"UM & Permissions"},
     * summary="activate user",
     * description="Activate a user within a company",
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
     *            mediaType="application-json",
     *            @OA\Schema(
     *               type="object",
     *               required={"userId"},
     *               @OA\Property(property="userId", type="integer"),
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=201,
     *          description="Activated Successfully ",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=200,
     *          description="activated Successfully",
     *          @OA\JsonContent()
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

    public function userActivate(UserAvtivateRerquest $request,UserServices $userServices) {
        return $userServices->userActivate($request);
    }

     /**
     * @OA\Put(
     * path="/api/v1_0/users/disable",
     * operationId=" disable",
     * tags={"UM & Permissions"},
     * summary="disable user",
     * description="disable a user within a company",
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
     *            mediaType="application-json",
     *            @OA\Schema(
     *               type="object",
     *               required={"userId"},
     *               @OA\Property(property="userId", type="integer"),
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=201,
     *          description="disabled Successfully ",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=200,
     *          description="activated Successfully",
     *          @OA\JsonContent()
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

    public function disable(UserAvtivateRerquest $request,UserServices $userServices) {
        return $userServices->disable($request);
    }


    /**
     * @OA\put(
     * path="/api/v1_0/users/setDefaultCompany",
     * operationId="defaultCompany",
     * tags={"UM & Permissions"},
     * summary="set default company",
     * description="set default company Here",
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
     *               required={"id","companyId"},
     *               @OA\Property(property="id", type="integer"),
     *               @OA\Property(property="companyId", type="integer")
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="Default company successfully'",
     *          @OA\JsonContent(),
     *          @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               @OA\Property(property="message", type="string"),
     *               @OA\Property(property="data",type = "object")
     *            ),
     *          ),
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
    public function setDefaultCompany(DefaultCompanyRequest $request,UserServices $userServices) {
        return $userServices->setDefaultCompany($request);
    }


    //////////////////////  doc
public function detachWarehouse(DeleteWarehouseRequest $request,UserServices $userServices) {
    return $userServices->detachWarehouse($request);
}

/////////       doc
public function userWarehouseStatus(UpdateUserWarehouseStatusRequest $request,UserServices $userServices) {
    return $userServices->userWarehouseStatus($request);
}

}
