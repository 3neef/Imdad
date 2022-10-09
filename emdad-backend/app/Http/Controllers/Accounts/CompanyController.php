<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use App\Http\Requests\AccountRequests\CreateAccountRequest;
use App\Http\Requests\AccountRequests\UpdateAccountRequest;
use App\Http\Requests\AccountRequests\GetByAccountIdRequest;
use App\Http\Requests\AccountRequests\RestoreAccountRequest;
use App\Http\Services\AccountServices\AccountService;

class CompanyController extends Controller
{

    protected $accountService;
 
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

    public function createAccount(CreateAccountRequest $request)
    {
        return $this->accountService->createCompany($request);
    }

    public function updateAccount(UpdateAccountRequest $request)
    {
        return $this->accountService->update($request);
    }

    public function getAllAccount()
    {
        return $this->accountService->getAll();
    }

    public function getByAccountId(GetByAccountIdRequest $request,$id)
    {
        return $this->accountService->getById($id);
    }

    public function deleteAccount(GetByAccountIdRequest $request,$id)
    {
        return $this->accountService->delete($id);
    }
    
    public function restoreByAccountId(RestoreAccountRequest $request,$id)
    {
        return $this->accountService->restore($id);
    }
}
