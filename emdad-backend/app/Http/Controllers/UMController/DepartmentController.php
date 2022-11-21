<?php

namespace App\Http\Controllers\UMController;
use App\Http\Controllers\Controller;
use App\Http\Requests\UMRequests\DepartmentRequest;
use App\Http\Services\UMServices\DepartmentServices;

class DepartmentController extends Controller
{


    public function __construct(DepartmentServices $departmentService) {
        $this->departmentService = $departmentService;
    }



     /**
        * @OA\Post(
        * path="/api/v1_0/department/create",
        * operationId="createdepartment",
        * tags={"Department"},
        * summary="create department ",
        * description="create department  Here",
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
        *               required={"name"},
        *               @OA\Property(property="name", type="string"),
        *            ),
        *        ),
        *    ),
        *      @OA\Response(
        *          response=200,
        *          description="department created Successfully"
        *       ),
        *      @OA\Response(response=404, description="Resource Not Found"),
        * )
        */
    public function create(DepartmentRequest $request)
    {
       return $this->departmentService->AddDepartment($request->validated());

    }
}
