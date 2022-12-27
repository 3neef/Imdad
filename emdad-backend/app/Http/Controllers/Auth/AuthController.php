<?php

namespace App\Http\Controllers\Auth;

use App\Http\Collections\UserCollection;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\RemoveUserRequets;
use App\Http\Requests\UMRequests\User\ActivateRequest;
use App\Http\Services\UMServices\UserServices;
use App\Http\Requests\UMRequests\User\AssignRoleRequest;
use App\Http\Requests\UMRequests\User\DefaultCompanyRequest;
use App\Http\Requests\UMRequests\User\GetUserByIdRequest;
use App\Http\Requests\UMRequests\User\ResetPasswordRequest;
use App\Http\Requests\UMRequests\User\ForgotPasswordRequest;
use App\Http\Requests\UMRequests\User\ResendOTPRequest;
use App\Http\Requests\UMRequests\User\RestoreUserByIdRequest;
use App\Http\Requests\UMRequests\User\StoreAuthRequest;
use App\Http\Requests\UMRequests\User\StoreUserRequest;
use App\Http\Requests\UMRequests\User\UpdateRequest;
use App\Http\Resources\UMResources\User\UserResponse;
use App\Http\Services\General\SmsService;


class AuthController extends Controller
{


    /**
     * @OA\put(
     * path="/api/v1_0/auth/reset-password",
     * operationId="resetPassword",
     * tags={"auth"},
     * summary="reset password",
     * description="reset password of company user",
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
     *             type="bearer"
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
    public function resetPassword(ResetPasswordRequest $request,UserServices $userServices) {
        return $userServices->resetPassword($request);
    }

     /**
     * @OA\Post(
     * path="/api/v1_0/auth/register",
     * operationId="registerUser",
     * tags={"auth"},
     * summary="Register User",
     * description="Register a User as an owner to company",
     *     @OA\Parameter(
     *         name="x-authorization",
     *         in="header",
     *         description="Set x-authorization",
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
     *               required={"fullName","password","email","mobile","identityNumber","expireDate"},
     *               @OA\Property(property="fullName", type="string"),
     *               @OA\Property(property="expireDate", type="date"),
     *               @OA\Property(property="lastName", type="string"),
     *               @OA\Property(property="password", type="string"),
     *               @OA\Property(property="email", type="email"),
     *               @OA\Property(property="mobile", type="string"),
     *               @OA\Property(property="identityNumber", type="string"),
     *               @OA\Property(property="identityType", type="string,nid")
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
    public function store(StoreAuthRequest $request, UserServices $userServices)
    {
        return $userServices->create($request->validated());
    }



    /**
     * @OA\Post(
     * path="/api/v1_0/auth/login",
     * operationId="authLogin",
     * tags={"auth"},
     * summary="User Login for owner user",
     * description="Login User Here",
     *     @OA\Parameter(
     *         name="x-authorization",
     *         in="header",
     *         description="Set x-authorization",
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
     *               required={"email","mobile"},
     *               @OA\Property(
     *                   oneOf={ @OA\Property(property="email",type="string"),
     *                           @OA\Property(property="mobile",type="string") }),
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
     * path="/api/v1_0/auth/verify-otp",
     * operationId="user-verify-otp",
     * tags={"auth"},
     * summary="User Activation/ user login mobile + otp",
     * description="activate by otp also allows login by confirming otp",
     *     @OA\Parameter(
     *         name="x-authorization",
     *         in="header",
     *         description="Set x-authorization",
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
     *               required={"id","otp","mobile"},
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
     * path="/api/v1_0/auth/resend-otp",
     * operationId="resend otp",
     * tags={"auth"},
     * summary="resend otp",
     * description="resend otp Here",
     *     @OA\Parameter(
     *         name="x-authorization",
     *         in="header",
     *         description="Set x-authorization",
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
     *               @OA\Property(property="mobile", type="string"),
     *               @OA\Property(property="email", type="email"),
     *            ),
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
     * path="/api/v1_0/auth/logout",
     * operationId="Logout",
     * tags={"auth"},
     * summary="User Logout",
     * description="Logout User Here",
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
     * @OA\post(
     * path="/api/v1_0/auth/forgot-password",
     * operationId="forgotPassword",
     * tags={"auth"},
     * summary="forgot password",
     * description="forgot password of the owner user ",
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
     * @OA\delete(
     * path="/api/v1_0/auth/remove-user/{id}",
     * operationId="removeUser",
     * tags={"auth"},
     * summary="remove User",
     * description="remove user here",
     *     @OA\Parameter(
     *         name="x-authorization",
     *         in="header",
     *         description="Set x-authorization",
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


}
