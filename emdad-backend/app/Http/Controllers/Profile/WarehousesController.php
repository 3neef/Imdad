<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\AccountRequests\Location\AssignUserToWarehouseRequest;
use App\Http\Requests\AccountRequests\Location\CreateWarehouesesRequest;
use App\Http\Requests\AccountRequests\Location\RestoreLocationRequest;
use App\Http\Requests\AccountRequests\Location\UnAssignWarehouseFromUserRequest;
use App\Http\Requests\AccountRequests\Location\UpdateWarehousesRequest;
use App\Http\Requests\AccountRequests\Location\VerfiedLocationRequest;
use App\Http\Services\AccountServices\WarehouseService;
use App\Models\Accounts\Warehouse;
use Illuminate\Http\Request;

class WarehousesController extends Controller
{
    protected WarehouseService $warehouseService;

    /**
     * Create a new controller instance.
     *
     * @param  App\Http\Services\AccountServices\LocationService  $warehouseService
     * @return void
     */
    public function __construct(WarehouseService $warehouseService)
    {
        $this->warehouseService = $warehouseService;
    }


    /**
        * @OA\get(
        * path="/api/v1_0/warehouses",
        * operationId="getAllWarehouses",
        * tags={"warehouse"},
        * summary="get all warehouse",
        * description="get all warehouses Here",
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
        *        response=200,
        *          description="get all warehouses",
        *          @OA\JsonContent(),
        *          @OA\MediaType(
        *            mediaType="multipart/form-data",
        *            @OA\Schema(
        *               type="array",@OA\Items(type = "object")
        *            ),
        *        ),
        *
        *       ),
        *      @OA\Response(response=500, description="system error"),
        *      @OA\Response(response=422, description="Validate error"),
        *      @OA\Response(response=404, description="Resource Not Found"),
        * )
        */
        public function index(Request $request)
        {
            return $this->warehouseService->index($request);
        }
/**
        * @OA\Post(
        * path="/api/v1_0/warehouses",
        * operationId="createWarehouse",
        * tags={"warehouse"},
        * summary="create warehouse",
        * description="create warehouse Here",
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
        *               required={"managerId","warehouseName","warehouseType","latitude","longitude","gateType","receiverName","receiverPhone"},
        *               @OA\Property(property="warehouseName", type="string"),
        *               @OA\Property(property="warehouseType", type="string"),
        *               @OA\Property(property="latitude", type="string"),
        *               @OA\Property(property="longitude", type="string"),
        *               @OA\Property(property="gateType", type="string"),
        *               @OA\Property(property="receiverName", type="string"),
        *               @OA\Property(property="receiverPhone", type="string"),
           *               @OA\Property(property="managerId", type="integer"),
        *            ),
        *        ),
        *    ),
        *      @OA\Response(
        *        response=200,
        *          description="created Successfully",
        *          @OA\JsonContent(),
        *          @OA\MediaType(
        *            mediaType="multipart/form-data",
        *            @OA\Schema(
        *               type="object",
        *               @OA\Property(property="message", type="string")
        *            ),
        *        ),
        *
        *       ),
        *      @OA\Response(response=500, description="system error"),
        *      @OA\Response(response=422, description="Validate error"),
        *      @OA\Response(response=404, description="Resource Not Found"),
        * )
        */
    public function store(CreateWarehouesesRequest $request)
    {
        return $this->warehouseService->store($request);
    }




/**
        * @OA\get(
        * path="/api/v1_0/warehouses/{id}'",
        * operationId="getWarehouseById",
        * tags={"warehouse"},
        * summary="get warehouse By Id",
        * description="get warehouse By Id Here",
     *     @OA\Parameter(
     *         name="id",
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
        *      @OA\Response(
        *        response=200,
        *          description="get warehouse By Id",
        *          @OA\JsonContent(),
        *          @OA\MediaType(
        *            mediaType="multipart/form-data",
        *            @OA\Schema(
        *               type="object"
        *            ),
        *        ),
        *
        *       ),
        *      @OA\Response(response=500, description="system error"),
        *      @OA\Response(response=422, description="Validate error"),
        *      @OA\Response(response=404, description="Resource Not Found"),
        * )
        */
        public function show($id)
        {
            $location=Warehouse::where("id",$id)->first();
            if($location==null||false){// replace false by checking user permission
                return response()->json(['success'=>false,'error' => 'not found'], 404);

            }
            return $this->warehouseService->show($id);
        }
/**
        * @OA\put(
        * path="/api/v1_0/warehouses/{id}",
        * operationId="updateWarehouse",
        * tags={"warehouse"},
        * summary="update warehouse",
        * description="update warehouse Here",
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
        *               required={"id"},
        *               @OA\Property(property="id", type="integer"),
        *               @OA\Property(property="warehouseName", type="string"),
        *               @OA\Property(property="warehouseType", type="string"),
        *               @OA\Property(property="latitude", type="string"),
        *               @OA\Property(property="longitude", type="string"),
        *               @OA\Property(property="gateType", type="string"),
        *               @OA\Property(property="receiverName", type="string"),
        *               @OA\Property(property="receiverPhone", type="string")
        *            ),
        *        ),
        *    ),
        *      @OA\Response(
        *        response=200,
        *          description="updated Successfully",
        *          @OA\JsonContent(),
        *          @OA\MediaType(
        *            mediaType="multipart/form-data",
        *            @OA\Schema(
        *               type="object",
        *               @OA\Property(property="message", type="string")
        *            ),
        *        ),
        *
        *       ),
        *      @OA\Response(response=500, description="system error"),
        *      @OA\Response(response=422, description="Validate error"),
        *      @OA\Response(response=404, description="Resource Not Found"),
        * )
        */
    public function update(UpdateWarehousesRequest $request,$id)
    {
        return $this->warehouseService->update($request,$id);
    }

/**
        * @OA\delete(
        * path="/api/v1_0/warehouses/{id}'",
        * operationId="deleteWarehouse",
        * tags={"warehouse"},
        * summary="delete warehouse",
        * description="delete warehouse Here",
     *     @OA\Parameter(
     *         name="id",
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
        *      @OA\Response(
        *        response=200,
        *        description="delete warehouse",
        *          @OA\JsonContent(),
        *          @OA\MediaType(
        *            mediaType="multipart/form-data",
        *            @OA\Schema(
        *               type="object",
        *               @OA\Property(property="message", type="string")
        *            ),
        *         ),
        *       ),
        *      @OA\Response(response=500, description="system error"),
        *      @OA\Response(response=422, description="Validate error"),
        *      @OA\Response(response=404, description="Resource Not Found"),
        * )
        */
    public function destroy($id)
    {

        return $this->warehouseService->delete($id);
    }
/**
        * @OA\put(
        * path="/api/v1_0/warehouses/restore/{id}'",
        * operationId="restoreWarehouseById",
        * tags={"warehouse"},
        * summary="restore warehouse By Id",
        * description="restore warehouse By Id Here",
     *     @OA\Parameter(
     *         name="id",
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
        *      @OA\Response(
        *        response=200,
        *          description="restore warehouse By Id",
        *          @OA\JsonContent(),
        *          @OA\MediaType(
        *            mediaType="multipart/form-data",
        *            @OA\Schema(
        *               type="object",
        *               @OA\Property(property="message", type="string")
        *            ),
        *          ),
        *       ),
        *      @OA\Response(response=500, description="system error"),
        *      @OA\Response(response=422, description="Validate error"),
        *      @OA\Response(response=404, description="Resource Not Found"),
        * )
        */
    public function restoreByLocationId($id)
    {
        return $this->warehouseService->restore($id);
    }
/**
        * @OA\put(
        * path="/api/v1_0/warehouses/verfied",
        * operationId="verfiedWarehouse",
        * tags={"warehouse"},
        * summary="verfied warehouse",
        * description="verfied warehouse",
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
        *               required={"id","userId","companyId"},
        *               @OA\Property(property="id", type="integer"),
        *               @OA\Property(property="userId", type="integer"),
        *               @OA\Property(property="companyId", type="integer")
        *            ),
        *        ),
        *    ),
        *      @OA\Response(
        *        response=200,
        *          description="verfied warehouse",
        *          @OA\JsonContent(),
        *          @OA\MediaType(
        *            mediaType="multipart/form-data",
        *            @OA\Schema(
        *               type="object",
        *               @OA\Property(property="message", type="string")
        *            ),
        *         ),
        *       ),
        *      @OA\Response(response=500, description="system error"),
        *      @OA\Response(response=422, description="Validate error"),
        *      @OA\Response(response=404, description="Resource Not Found"),
        * )
        */
    public function verfiedLocation($id)
    {
        return $this->warehouseService->verfied($id);
    }

/**
        * @OA\post(
        * path="/api/v1_0/assignwarehousetouser",
        * operationId="assignwarehousetouser",
        * tags={"warehouse"},
        * summary="assign warehouse to user",
        * description="assign warehouse to user",
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
        *               required={"userId","warehouseId"},
        *               @OA\Property(property="warehouseId", type="integer"),
        *               @OA\Property(property="userId", type="integer"),
        *            ),
        *        ),
        *    ),
        *      @OA\Response(
        *        response=200,
        *          description="assign warehouse",
        *          @OA\JsonContent(),
        *          @OA\MediaType(
        *            mediaType="multipart/form-data",
        *            @OA\Schema(
        *               type="object",
        *               @OA\Property(property="message", type="string")
        *            ),
        *         ),
        *       ),
        *      @OA\Response(response=500, description="system error"),
        *      @OA\Response(response=422, description="Validate error"),
        *      @OA\Response(response=404, description="Resource Not Found"),
        * )
        */
    public function assignWarehouseToUser(AssignUserToWarehouseRequest $request)
    {
        return $this->warehouseService->assignWarehouseToUser($request);
    }

    
/**
        * @OA\delete(
        * path="/api/v1_0/unassignwarehousetouser/{id}",
        * operationId="unAssignWarehouseToUser",
        * tags={"warehouse"},
        * summary="unassign warehouse to user",
        * description="unassign warehouse to user",
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
        *               required={"warehouseId"},
        *               @OA\Property(property="warehouseId", type="integer"),
        *            ),
        *        ),
        *    ),
        *      @OA\Response(
        *        response=200,
        *          description="unassign warehouse",
        *          @OA\JsonContent(),
        *          @OA\MediaType(
        *            mediaType="multipart/form-data",
        *            @OA\Schema(
        *               type="object",
        *               @OA\Property(property="message", type="string")
        *            ),
        *         ),
        *       ),
        *      @OA\Response(response=500, description="system error"),
        *      @OA\Response(response=422, description="Validate error"),
        *      @OA\Response(response=404, description="Resource Not Found"),
        * )
        */
    public function unAssignWarehouseFromUser(UnAssignWarehouseFromUserRequest $request)
    {
        return $this->warehouseService->unAssignWarehouseFromUser($request);
    }
    
}
