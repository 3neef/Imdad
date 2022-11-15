<?php

namespace App\Http\Controllers\UMController;
use App\Http\Controllers\Controller;
use App\Http\Requests\UMRequests\DepartmentRequest;
use App\Http\Services\UMServices\DepartmentServices;

class DepartmentController extends Controller
{

    protected DepartmentServices $departmentService;
    
    public function __construct(DepartmentServices $departmentService) {
        $this->departmentService = $departmentService;
    }
    public function create(DepartmentRequest $request)
    {
       return $this->departmentService->AddDepartment($request->validated());

    }
}
