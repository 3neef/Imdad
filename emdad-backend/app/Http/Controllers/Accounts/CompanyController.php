<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use App\Http\Requests\AccountRequests\Account\AddMoreCompanyRequest;
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
        * tags={"Account Controller"},
        * summary="create Company Account",
        * description="create Company Account Here",
        *     @OA\RequestBody(
        *         @OA\JsonContent(),
        *         @OA\MediaType(
        *            mediaType="multipart/form-data",
        *            @OA\Schema(
        *               type="object",
        *               required={"firstName","lastName", "companyType", "roleId","personId","idType","contactPhone","contactEmail"},
        *               @OA\Property(property="firstName", type="string"),
        *               @OA\Property(property="lastName", type="string"),
        *               @OA\Property(property="companyType", type="integer"),
        *               @OA\Property(property="roleId", type="integer"),
        *               @OA\Property(property="personId", type="string"),
        *               @OA\Property(property="idType", type="string"),
        *               @OA\Property(property="contactPhone", type="string",example="00966xxxxxxxxx"),
        *               @OA\Property(property="contactEmail", type="email"),
        *               @OA\Property(property="subscriptionId", type="integer")
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

    public function createAccount(CreateAccountRequest $request)
    {
        return $this->accountService->createCompany($request);
    }


    public function addAccount(AddMoreCompanyRequest $request)
    {
       return $this->accountService->addMoreCompany($request);
    }

    /**
        * @OA\put(
        * path="/api/v1_0/accounts/update",
        * operationId="updateAccount",
        * tags={"Account Controller"},

        * summary="update Account",
        * description="update Account Here",
        *     @OA\RequestBody(
        *         @OA\JsonContent(),
        *         @OA\MediaType(
        *            mediaType="multipart/form-data",
        *            @OA\Schema(
        *               type="object",
        *               required={"id","name","companyId","companyType","companyVatId","contactName","contactPhone","contactEmail"},
        *               @OA\Property(property="id", type="integer"),
        *               @OA\Property(property="name", type="string"),
        *               @OA\Property(property="companyId", type="string"),
        *               @OA\Property(property="companyType", type="integer"),
        *               @OA\Property(property="companyVatId", type="string"),
        *               @OA\Property(property="contactName", type="string"),
        *               @OA\Property(property="contactPhone", type="string"),
        *               @OA\Property(property="contactEmail", type="email")
        *            ),
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


    public function updateAccount(UpdateAccountRequest $request)
    {
        return $this->accountService->update($request);
    }
/**
        * @OA\get(
        * path="/api/v1_0/accounts/getAll",
        * operationId="getAllaccounts",
              * tags={"Account Controller"},

        * summary="get All Accounts",
        * description="get All Accounts Here",
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
        *          description="",
        *         @OA\JsonContent(
        *         @OA\Property(property="MainAccount", type="integer", example="{'id': 1}")
        *          ),
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
               * tags={"Account Controller"},

        * summary="get By AccountId",
        * description="get By AccountId Here",
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
    public function getByAccountId(GetByAccountIdRequest $request,$id)
    {
        return $this->accountService->getById($id);
    }
/**
        * @OA\delete(
        * path="/api/v1_0/accounts/delete/{id}",
        * operationId="deleteAccount",
               * tags={"Account Controller"},

        * summary="delete Account",
        * description="delete Account",
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
    public function deleteAccount(GetByAccountIdRequest $request,$id)
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
    public function restoreByAccountId(RestoreAccountRequest $request,$id)
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


    public function allUnValidatedAccounts()
    {
        return $this->accountService->unValidate();
    }

/**
        * @OA\put(
        * path="/api/v1_0/accounts/validate/{id}",
        * operationId="validatedAccount",
             * tags={"Account Controller"},

        * summary="validatedAccount",
        * description="validatedAccount",
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
    public function validatedAccount(GetByAccountIdRequest $request,$id)
    {
        return $this->accountService->validate($id);
    }
}
