<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use App\Http\Requests\AccountRequests\Account\CreateAccountRequest;
use App\Http\Requests\AccountRequests\Account\UpdateAccountRequest;
use App\Http\Requests\AccountRequests\Account\GetByAccountIdRequest;
use App\Http\Requests\AccountRequests\Account\RestoreAccountRequest;
use App\Http\Services\AccountServices\AccountService;

class CompanyController extends Controller
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
        * @OA\Post(
        * path="/api/v1_0/accounts/create",
        * operationId="createAccount",
        * tags={"createCompanyAccount"},
        * summary="create Company Account",
        * description="create Company Account Here",
        *     @OA\RequestBody(
        *         @OA\JsonContent(),
        *         @OA\MediaType(
        *            mediaType="multipart/form-data",
        *            @OA\Schema(
        *               type="object",
        *               required={"name", "companyId" ,"companyType","companyVatId","contactName","contactPhone","contactEmail","subscriptionId"},
        *               @OA\Property(property="name", type="string"),
        *               @OA\Property(property="companyId", type="string"),
        *               @OA\Property(property="companyType", type="integer"),
        *               @OA\Property(property="companyVatId", type="string"),
        *               @OA\Property(property="contactName", type="string"),
        *               @OA\Property(property="contactPhone", type="string"),
        *               @OA\Property(property="contactEmail", type="email"),
        *               @OA\Property(property="subscriptionId", type="integer"),
        *            ),
        *        ),
        *    ),
        *      @OA\Response(
        *        response=200,
        *          description="created Successfully",
        *          @OA\JsonContent(response=500, description="system error")
        *       ),
        *      @OA\Response(response=500, description="system error"),
        *      @OA\Response(response=422, description="Validate error"),
        *      @OA\Response(response=404, description="Resource Not Found"),
        * )
        */

    public function createAccount(CreateAccountRequest $request)
    {
        return $this->accountService->createCompany($request);
    }

    /**
        * @OA\put(
        * path="/api/v1_0/accounts/update",
        * operationId="updateAccount",
        * tags={"updateAccount"},
        * summary="update Account",
        * description="update Account Here",
        *     @OA\RequestBody(
        *         @OA\JsonContent(),
        *         @OA\MediaType(
        *            mediaType="multipart/form-data",
        *            @OA\Schema(
        *               type="object",
        *               required={"id", "name" ,"companyId","companyType","companyVatId","contactName","contactPhone","contactEmail"},
        *               @OA\Property(property="id", type="integer"),
        *               @OA\Property(property="name", type="string"),
        *               @OA\Property(property="companyId", type="string"),
        *               @OA\Property(property="companyType", type="integer"),
        *               @OA\Property(property="companyVatId", type="string"),
        *               @OA\Property(property="contactName", type="string"),
        *               @OA\Property(property="contactPhone", type="string"),
        *               @OA\Property(property="contactEmail", type="email"),
        *            ),
        *        ),
        *    ),
        *      @OA\Response(
        *        response=200,
        *          description="updated Successfully",
        *          @OA\JsonContent(response=500, description="system error")
        *       ),
        *      @OA\Response(response=500, description="system error"),
        *      @OA\Response(response=422, description="Validate error"),
        *      @OA\Response(response=404, description="Resource Not Found"),
        * )
        */


    public function updateAccount(UpdateAccountRequest $request)
    {
        return $this->accountService->update($request);
    }
/**
        * @OA\get(
        * path="/api/v1_0/accounts/getAll",
        * operationId="getAllaccounts",
        * tags={"get All accounts"},
        * summary="get All Accounts",
        * description="get All Accounts Here",
        *     @OA\RequestBody(
        *         @OA\JsonContent(),
        *         @OA\MediaType(
        *            mediaType="multipart/form-data",
        *            @OA\Schema(
        *               type="object",
        *               required={""},
        *               @OA\Property(property="", type=""),
        *            ),
        *        ),
        *    ),
        *      @OA\Response(
        *        response=200,
        *          description="data=>array",
        *       ),
        *      @OA\Response(response=404, description="Resource Not Found"),
        * )
        */
    public function getAllAccount()
    {
        return $this->accountService->getAll();
    }
/**
        * @OA\get(
        * path="/api/v1_0/accounts/getById/{id}",
        * operationId="getByAccountId",
        * tags={"get By AccountId"},
        * summary="get By AccountId",
        * description="get By AccountId Here",
        *     @OA\RequestBody(
        *         @OA\JsonContent(),
        *         @OA\MediaType(
        *            mediaType="multipart/form-data",
        *            @OA\Schema(
        *               type="object",
        *               required={"id"},
        *               @OA\Property(property="id", type="integer"),
        *            ),
        *        ),
        *    ),
        *      @OA\Response(
        *        response=200,
        *          description="data=>array",
        *       ),
        *      @OA\Response(response=404, description="Resource Not Found"),
        * )
        */
    public function getByAccountId(GetByAccountIdRequest $request,$id)
    {
        return $this->accountService->getById($id);
    }
/**
        * @OA\delete(
        * path="/api/v1_0/accounts/delete/{id}",
        * operationId="deleteAccount",
        * tags={"delete Account"},
        * summary="delete Account",
        * description="delete Account",
        *     @OA\RequestBody(
        *         @OA\JsonContent(),
        *         @OA\MediaType(
        *            mediaType="multipart/form-data",
        *            @OA\Schema(
        *               type="object",
        *               required={"id"},
        *               @OA\Property(property="id", type="integer"),
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
    public function deleteAccount(GetByAccountIdRequest $request,$id)
    {
        return $this->accountService->delete($id);
    }
/**
        * @OA\put(
        * path="/api/v1_0/accounts/restore/{id}",
        * operationId="restore By AccountId",
        * tags={"restore By AccountId"},
        * summary="restore By AccountId",
        * description="restore By AccountId",
        *     @OA\RequestBody(
        *         @OA\JsonContent(),
        *         @OA\MediaType(
        *            mediaType="multipart/form-data",
        *            @OA\Schema(
        *               type="object",
        *               required={"id"},
        *               @OA\Property(property="id", type="integer"),
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
    public function restoreByAccountId(RestoreAccountRequest $request,$id)
    {
        return $this->accountService->restore($id);
    }

/**
        * @OA\get(
        * path="/api/v1_0/accounts/getAllUnValidated",
        * operationId="all UnValidated Accounts",
        * tags={"all UnValidated Accounts"},
        * summary="allUnValidatedAccounts",
        * description="allUnValidatedAccounts",
        *     @OA\RequestBody(
        *         @OA\JsonContent(),
        *         @OA\MediaType(
        *            mediaType="multipart/form-data",
        *            @OA\Schema(
        *               type="object",
        *               required={""},
        *               @OA\Property(property="", type=""),
        *            ),
        *        ),
        *    ),
        *      @OA\Response(
        *        response=200,
        *          description="all companys validated collections ",
        *       ),
        *      @OA\Response(response=404, description="Resource Not Found"),
        *      @OA\Response(response=500, description="system error"),
        * )
        */


    public function allUnValidatedAccounts()
    {
        return $this->accountService->unValidate();
    }

/**
        * @OA\put(
        * path="/api/v1_0/accounts/validate/{id}",
        * operationId="validatedAccount",
        * tags={"validatedAccount"},
        * summary="validatedAccount",
        * description="validatedAccount",
        *     @OA\RequestBody(
        *         @OA\JsonContent(),
        *         @OA\MediaType(
        *            mediaType="multipart/form-data",
        *            @OA\Schema(
        *               type="object",
        *               required={"id"},
        *               @OA\Property(property="id", type="integer"),
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
    public function validatedAccount(GetByAccountIdRequest $request,$id)
    {
        return $this->accountService->validate($id);
    }
}
