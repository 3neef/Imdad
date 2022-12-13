<?php

namespace App\Http\Controllers;

use App\Http\Collections\ProfileCollection;
use App\Http\Requests\AccountRequests\Account\GetByAccountIdRequest;
use App\Http\Requests\AccountRequests\Account\RestoreAccountRequest;
use App\Http\Requests\Profile\StoreProfileRequest;
use App\Http\Requests\Profile\UpdateProfileRequest;
use App\Http\Services\AccountServices\AccountService;

class ProfileController extends Controller
{

    protected AccountService $accountService;

    /**
     * Create a new controller instance.
     *
     * @param  App\Http\Services\AccountServices\AccountService  $accountService
     * @return void
     */
    public function __construct(AccountService $accountService)
    {
        $this->accountService = $accountService;
    }


 /**
     * @OA\get(
     * path="/api/v1_0/accounts/filter-company-info",
     * operationId="filtercompanyinfo",
     * tags={"Account Controller"},
     * summary="filter company info",
     * description="filter company info Here",
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
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *        response=200,
     *          description="collection",
     *
     *       ),
     *      @OA\Response(response=500, description="system error"),
     *      @OA\Response(response=422, description="Validate error"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */



    public function index()
    {
        return ProfileCollection::collection();
    }

    /**
     * @OA\Post(
     * path="/api/v1_0/accounts/add-company",
     * operationId="createAccount",
     * tags={"Account Controller"},
     * summary="create Company Account",
     * description="create Company Account Here",
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
     *               required={"crNo","roleId", "companyType"},
     *               @OA\Property(property="roleId", type="integer"),
     *               @OA\Property(property="crNo", type="string"),
     *               @OA\Property(property="companyType", type="integer"),
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *        response=200,
     *          description="created Successfully",
     *
     *       ),
     *      @OA\Response(response=500, description="system error"),
     *      @OA\Response(response=422, description="Validate error"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function store(StoreProfileRequest $request)
    {
        return $this->accountService->store($request);
    }


    /**
     * @OA\get(
     * path="/api/v1_0/accounts/getById/{id}",
     * operationId="getByAccountId",
     * tags={"Account Controller"},

     * summary="get By AccountId",
     * description="get By AccountId Here",
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
     *               required={"id"},
     *               @OA\Property(property="id", type="integer")
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *        response=200,
     *          description="",
     *         @OA\JsonContent(
     *         @OA\Property(property="AccountById", type="integer", example="{'id': 2}")
     *          ),
     *       ),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function show($id)
    {
        return $this->accountService->show($id);
    }

    /**
     * @OA\put(
     * path="/api/v1_0/accounts/update",
     * operationId="updateAccount",
     * tags={"Account Controller"},

     * summary="update Account",
     * description="update Account Here",
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
     *               required={"id"},
     *               @OA\Property(property="id", type="integer")
     *             ),
     *        ),
     *    ),
     *      @OA\Response(
     *        response=200,
     *          description="updated Successfully",
     *
     *       ),
     *      @OA\Response(response=500, description="system error"),
     *      @OA\Response(response=422, description="Validate error"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */


    public function update(UpdateProfileRequest $request,$id)
    {
        return $this->accountService->update($request,$id);
    }

    /**
     * @OA\delete(
     * path="/api/v1_0/accounts/delete/{id}",
     * operationId="deleteAccount",
     * tags={"Account Controller"},

     * summary="delete Account",
     * description="delete Account",
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
     *               required={"id"},
     *               @OA\Property(property="id", type="integer")
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *        response=301,
     *          description="deleted successfully",
     *       ),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      @OA\Response(response=500, description="system error"),
     * )
     */
    public function destroy($id)
    {
        return $this->accountService->delete($id);
    }
    /**
     * @OA\put(
     * path="/api/v1_0/accounts/restore/{id}",
     * operationId="restoreByAccountId",
     * tags={"Account Controller"},

     * summary="restore By AccountId",
     * description="restore By AccountId",
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
     *               required={"id"},
     *               @OA\Property(property="id", type="integer")
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *        response=200,
     *          description="restored successfully",
     *       ),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      @OA\Response(response=500, description="system error"),
     * )
     */
    public function restoreByAccountId($id)
    {
        return $this->accountService->restore($id);
    }

    /**
     * @OA\get(
     * path="/api/v1_0/accounts/getAllUnValidated",
     * operationId="allUnValidatedAccounts",
     * tags={"Account Controller"},

     * summary="allUnValidatedAccounts",
     * description="allUnValidatedAccounts",
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
     *               required={""},
     *               @OA\Property(property="", type="")
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *        response=200,
     *          description="all companys validated collections ",
     *         @OA\JsonContent(
     *         @OA\Property(property="AllUnVAlidateAccount", type="integer", example="{'id': 2}")
     *          ),
     *       ),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      @OA\Response(response=500, description="system error"),
     * )
     */


    // public function allUnValidatedAccounts()
    // {
    //     return $this->accountService->unValidate();
    // }

    /**
     * @OA\put(
     * path="/api/v1_0/accounts/validate/{id}",
     * operationId="validatedAccount",
     * tags={"Account Controller"},

     * summary="validatedAccount",
     * description="validatedAccount",
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
     *               required={"id"},
     *               @OA\Property(property="id", type="integer")
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *        response=200,
     *          description="validated successfully ",
     *       ),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      @OA\Response(response=500, description="system error"),
     * )
     */
    // public function validatedAccount(GetByAccountIdRequest $request, $id)
    // {
    //     return $this->accountService->validate($id);
    // }
}


