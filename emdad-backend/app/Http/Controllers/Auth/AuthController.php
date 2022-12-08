<?php

namespace App\Http\Controllers\Auth;

use App\Http\Collections\UserCollection;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\RemoveUserRequets;
use App\Http\Requests\UMRequests\User\ActivateRequest;
use App\Http\Services\UMServices\UserServices;
use App\Http\Requests\UMRequests\User\GetUserRequest;
use App\Http\Requests\UMRequests\User\AssignRoleRequest;
use App\Http\Requests\UMRequests\User\CreateUserRequest;
use App\Http\Requests\UMRequests\User\DefaultCompanyRequest;
use App\Http\Requests\UMRequests\User\GetUserByIdRequest;
use App\Http\Requests\UMRequests\User\ResetPasswordRequest;
use App\Http\Requests\UMRequests\User\ForgotPasswordRequest;
use App\Http\Requests\UMRequests\User\ResendOTPRequest;
use App\Http\Requests\UMRequests\User\RestoreUserByIdRequest;
use App\Http\Requests\UMRequests\User\UpdateRequest;
use App\Http\Resources\UMResources\User\UserResponse;
use App\Http\Services\General\SmsService;
use App\Models\User;
use GuzzleHttp\Psr7\Request;
use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Http\Request as HttpRequest;

class AuthController extends Controller
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
    public function createUser(CreateUserRequest $request, UserServices $userServices)
    {
        return $userServices->create($request->validated());
    }

    /**
     * @OA\put(
     * path="/api/v1_0/users/update",
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
    public function updateUser(UpdateRequest $request, UserServices $userServices)
    {
        return $userServices->update($request);
    }

    /**
     * @OA\Post(
     * path="/api/v1_0/users/login",
     * operationId="authLogin",
     * tags={"UM & Permissions"},
     * summary="User Login",
     * description="Login User Here",
     *     @OA\Parameter(
     *         name="api_key",
     *         in="header",
     *         description="Set api_key",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"email","password"},
     *               @OA\Property(property="email", type="email"),
     *               @OA\Property(property="password", type="password")
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=201,
     *          description="Login Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=200,
     *          description="Login Successfully",
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

    public function loginUser(LoginRequest $request, UserServices $userServices)
    {
        return $userServices->login($request);
    }

    /**
     * @OA\Put(
     * path="/api/v1_0/users/verifiy-otp",
     * operationId="user-verify-otp",
     * tags={"UM & Permissions"},
     * summary="User Activation/ user login mobile + otp",
     * description="activate by otp also allows login by confirming otp",
     *     @OA\Parameter(
     *         name="api_key",
     *         in="header",
     *         description="Set api_key",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="application-json",
     *            @OA\Schema(
     *               type="object",
     *               required={"otp"},
     *               @OA\Property(property="id", type="integer"),
     *               @OA\Property(property="otp", type="string"),
     *               @OA\Property(property="mobile", type="string")
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=201,
     *          description="Login Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=200,
     *          description="Login Successfully",
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

    public function activateUser(ActivateRequest $request, UserServices $userServices)
    {
        return $userServices->activate($request);
    }
    /**
     * @OA\Post(
     * path="/api/v1_0/users/resend-otp",
     * operationId="resend otp",
     * tags={"UM & Permissions"},
     * summary="resend otp",
     * description="resend otp Here",
     *     @OA\Parameter(
     *         name="api_key",
     *         in="header",
     *         description="Set api_key",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="application-json",
     *            @OA\Schema(
     *               type="object",
     *               @OA\Property(property="otp rest", type="object",
     *                  @OA\AdditionalProperties(type="array",
     *                      @OA\Items(
     *                          @OA\Property(property="email", type="email"),
     *                          @OA\Property(property="phone", type="string")
     *                      )
     *                  )
     *              ),
     *            )
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="resent new otp",
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
    public function resendOTP(ResendOTPRequest $request, UserServices $userServices)
    {
        return $userServices->resend($request);
    }
    /**
     * @OA\Post(
     * path="/api/v1_0/users/logout",
     * operationId="Logout",
     * tags={"UM & Permissions"},
     * summary="User Logout",
     * description="Logout User Here",
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
     *          description="Logged out",
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
    public function logoutUser(UserServices $userServices)
    {
        return $userServices->logout();
    }
    /**
     * @OA\delete(
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
    public function deleteUser(GetUserByIdRequest $request, $id, UserServices $userServices)
    {
        return $userServices->delete($id);
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
     * @OA\put(
     * path="/api/v1_0/users/forgot-password",
     * operationId="forgotPassword",
     * tags={"UM & Permissions"},
     * summary="forgot password",
     * description="forgot password Here",
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
     *               required={"email"},
     *               @OA\Property(property="email", type="email")
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="sended otp",
     *          @OA\JsonContent(),
     *          @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               @OA\Property(property="message", type="string"),
     *               @OA\Property(property="OTP", type="integer"),
     *               @OA\Property(property="otpExpiresAt", type="string")
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
    public function forgotPassword(ForgotPasswordRequest $request, UserServices $userServices)
    {
        return $userServices->forgotPassword($request);
    }
    /**
     * @OA\put(
     * path="/api/v1_0/users/reset-password",
     * operationId="resetPassword",
     * tags={"UM & Permissions"},
     * summary="reset password",
     * description="reset password Here",
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
     *               required={"email","oldPassword","newPassword"},
     *               @OA\Property(property="email", type="email"),
     *               @OA\Property(property="oldPassword", type="string"),
     *               @OA\Property(property="newPassword", type="string")
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="Password has been reset successfully!!",
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
     *          description="Unprocessable Entity",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function resetPassword(
        ResetPasswordRequest $request,
        UserServices $userServices
    ) {
        return $userServices->resetPassword($request);
    }
    /**
     * @OA\post(
     * path="/api/v1_0/users/assginRole",
     * operationId="assginRole",
     * tags={"UM & Permissions"},
     * summary="assgin Role",
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
     *               required={"userId","role","companyId"},
     *               @OA\Property(property="userId", type="integer"),
     *               @OA\Property(property="role", type="string,integer"),
     *               @OA\Property(property="companyId", type="integer")
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="assign role successfully",
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
    public function assignRole(
        AssignRoleRequest $request,
        UserServices $userServices
    ) {
        return $userServices->assignRole($request);
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
    public function unAssignRole(
        AssignRoleRequest $request,
        UserServices $userServices
    ) {
        return $userServices->unAssignRole($request);
    }
    /**
     * @OA\post(
     * path="/api/v1_0/users/oldRole",
     * operationId="restoreOldRole",
     * tags={"UM & Permissions"},
     * summary="restore old Role",
     * description="restore old Role Here",
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
     *          description="restored successfully'",
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
     *          description="Unprocessable Entity",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function restoreOldRole(
        AssignRoleRequest $request,
        UserServices $userServices
    ) {
        return $userServices->restoreOldRole($request);
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
    /**
     * @OA\delete(
     * path="/api/v1_0/users/remove-user/{id}",
     * operationId="removeUser",
     * tags={"UM & Permissions"},
     * summary="remove User",
     * description="remove user here",
     *     @OA\Parameter(
     *         name="api_key",
     *         in="header",
     *         description="Set api_key",
     *         @OA\Schema(
     *             type="string"
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

    public function removeUser(
        RemoveUserRequets $request,
        $id,
        UserServices $userServices
    ) {
        return $userServices->removeUser($id);
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
    public function getUserInfoByToken(HttpRequest $request)
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
}
