<?php

namespace App\Http\Controllers\User;

use App\Http\Collections\UserCollection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UMRequests\User\AssignRoleRequest;
use App\Http\Requests\UMRequests\User\DefaultCompanyRequest;
use App\Http\Requests\UMRequests\User\GetUserByIdRequest;
use App\Http\Requests\UMRequests\User\RestoreUserByIdRequest;
use App\Http\Requests\UMRequests\User\StoreUserRequest;
use App\Http\Requests\UMRequests\User\UpdateRequest;
use App\Http\Resources\UMResources\User\UserResponse;
use App\Http\Services\UMServices\UserServices;


class UserController extends Controller
{
    public function index()
    {
        return UserCollection::collection();
    }


    /**
     * @OA\Post(
     * path="/api/v1_0/users/register",
     * operationId="registerUser",
     * tags={"UM & Permissions"},
     * summary="Register User",
     * description="Register User Here",
     *     @OA\Parameter(
     *         name="api_key",
     *         in="header",
     *         description="Set api_key",
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
     *               required={"firstName","lastName","password","email","mobile","identityNumber","identityType","roleId","expireDate"},
     *               @OA\Property(property="firstName", type="string"),
     *               @OA\Property(property="expireDate", type="date"),
     *               @OA\Property(property="lastName", type="string"),
     *               @OA\Property(property="password", type="string"),
     *               @OA\Property(property="email", type="email"),
     *               @OA\Property(property="mobile", type="string"),
     *               @OA\Property(property="identityNumber", type="string"),
     *               @OA\Property(property="identityType", type="string")
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
     *         name="api_key",
     *         in="header",
     *         description="Set api_key",
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
     * @OA\@put(
     * path="/api/v1_0/users",
     * operationId="updateUser",
     * tags={"UM & Permissions"},
     * summary="update User",
     * description="update User Here",
     *     @OA\Parameter(
     *         name="api_key",
     *         in="header",
     *         description="Set api_key",
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
     *               @OA\Property(property="password", type="string"),
     *               @OA\Property(property="firstName", type="string"),
     *               @OA\Property(property="lastName", type="string"),
     *               @OA\Property(property="roleId", type="integer"),
     *               @OA\Property(property="email", type="email"),
     *               @OA\Property(property="mobile", type="string"),
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
    public function update(UpdateRequest $request, UserServices $userServices)
    {
        return $userServices->update($request);
    }


    /**
     * @OA\put(
     * path="/api/v1_0/users/restore/{id}",
     * operationId="restoreUser",
     * tags={"UM & Permissions"},
     * summary="Restore User",
     * description="restore user here",
     *     @OA\Parameter(
     *         name="api_key",
     *         in="header",
     *         description="Set api_key",
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
    public function restoreUser(RestoreUserByIdRequest $request, $id, UserServices $userServices)
    {
        return $userServices->restoreById($id);
    }



    /**
     * @OA\@delete(
     * path="/api/v1_0/users/delete/{id}",
     * operationId="deleteUser",
     * tags={"UM & Permissions"},
     * summary="Delete User",
     * description="delete user here",
     *     @OA\Parameter(
     *         name="api_key",
     *         in="header",
     *         description="Set api_key",
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
    public function destroy(GetUserByIdRequest $request, $id, UserServices $userServices)
    {
        return $userServices->delete($id);
    }



    /**
     * @OA\post(
     * path="/api/v1_0/users/unAssginRole",
     * operationId="unassginRole",
     * tags={"UM & Permissions"},
     * summary="Unassgin Role",
     * description="assgin Role Here",
     *     @OA\Parameter(
     *         name="api_key",
     *         in="header",
     *         description="Set api_key",
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
     *               required={"userId","companyId"},
     *               @OA\Property(property="userId", type="integer"),
     *               @OA\Property(property="companyId", type="integer")
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="unassign role successfully",
     *          @OA\JsonContent(),
     *          @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               @OA\Property(property="message", type="string")
     *            ),
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
    public function Activate(
        AssignRoleRequest $request,
        UserServices $userServices
    ) {
        return $userServices->unAssignRole($request);
    }





    /**
     * @OA\put(
     * path="/api/v1_0/users/setDefaultCompany",
     * operationId="defaultCompany",
     * tags={"UM & Permissions"},
     * summary="set default company",
     * description="set default company Here",
     *     @OA\Parameter(
     *         name="api_key",
     *         in="header",
     *         description="Set api_key",
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
    public function setDefaultCompany(
        DefaultCompanyRequest $request,
        UserServices $userServices
    ) {
        return $userServices->setDefaultCompany($request);
    }
}
