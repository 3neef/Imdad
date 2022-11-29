<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use App\Http\Services\AccountServices\LocationService;
use App\Http\Requests\AccountRequests\Location\CreateLocationRequest;
use App\Http\Requests\AccountRequests\Location\UpdateLocationRequest;
use App\Http\Requests\AccountRequests\Location\GetByLocationIdRequest;
use App\Http\Requests\AccountRequests\Location\RestoreLocationRequest;
use App\Http\Requests\AccountRequests\Location\VerfiedLocationRequest;

class LocationController extends Controller
{
    protected LocationService $locationService;
    
    /**
     * Create a new controller instance.
     *
     * @param  App\Http\Services\AccountServices\LocationService  $locationService
     * @return void
     */
    public function __construct(LocationService $locationService)
    {
        $this->locationService = $locationService;
    }
/**
        * @OA\Post(
        * path="/api/v1_0/warehouses/create",
        * operationId="createWarehouse",
        * tags={"warehouse"},
        * summary="create warehouse",
        * description="create warehouse Here",
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
        *               required={"warehouseName","warehouseType","location","gateType","receiverName","receiverPhone"},
        *               @OA\Property(property="warehouseName", type="string"),
        *               @OA\Property(property="warehouseType", type="string"),
        *               @OA\Property(property="location", type="integer"),
        *               @OA\Property(property="gateType", type="string"),
        *               @OA\Property(property="receiverName", type="string"),
        *               @OA\Property(property="receiverPhone", type="string")
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
    public function saveLocation(CreateLocationRequest $request)
    {
        return $this->locationService->save($request);
    }
/**
        * @OA\put(
        * path="/api/v1_0/warehouses/update",
        * operationId="updateWarehouse",
        * tags={"warehouse"},
        * summary="update warehouse",
        * description="update warehouse Here",
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
        *               @OA\Property(property="id", type="integer"),
        *               @OA\Property(property="warehouseName", type="string"),
        *               @OA\Property(property="warehouseType", type="string"),
        *               @OA\Property(property="location", type="integer"),
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
    public function updateLocation(UpdateLocationRequest $request)
    {
        return $this->locationService->update($request);
    }
/**
        * @OA\get(
        * path="/api/v1_0/warehouses/getAll",
        * operationId="getAllWarehouses",
        * tags={"warehouse"},
        * summary="get all warehouse",
        * description="get all warehouses Here",
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
    public function getAllLocations()
    {
        return $this->locationService->getAll();
    }
/**
        * @OA\get(
        * path="/api/v1_0/warehouses/getByCompanyId/{companyId}",
        * operationId="getByCompanyIdWarehouse",
        * tags={"warehouse"},
        * summary="get warehouse by company id",
        * description="get warehouse by company id Here",
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
        *        response=200,
        *          description="get warehouse by company id",
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
    public function getByLocationByCompanyId(GetByLocationIdRequest $request,$id)
    {
        return $this->locationService->showByCompanyId($id);
    }
/**
        * @OA\get(
        * path="/api/v1_0/warehouses/getByUserId/{userId}'",
        * operationId="getWarehouseUserById",
        * tags={"warehouse"},
        * summary="get warehouse By UserId",
        * description="get warehouse By UserId Here",
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
        *        response=200,
        *          description="get warehouse By UserId",
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
    public function getByLocationByUserId(GetByLocationIdRequest $request,$id)
    {
        return $this->locationService->showByUserId($id);
    }
/**
        * @OA\get(
        * path="/api/v1_0/warehouses/getById/{id}'",
        * operationId="getWarehouseById",
        * tags={"warehouse"},
        * summary="get warehouse By Id",
        * description="get warehouse By Id Here",
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
    public function getByLocationById(GetByLocationIdRequest $request,$id)
    {
        return $this->locationService->showById($id);
    }
/**
        * @OA\delete(
        * path="/api/v1_0/warehouses/delete/{id}'",
        * operationId="deleteWarehouse",
        * tags={"warehouse"},
        * summary="delete warehouse",
        * description="delete warehouse Here",
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
    public function deleteLocation(GetByLocationIdRequest $request,$id)
    {
        return $this->locationService->delete($id);
    }
/**
        * @OA\put(
        * path="/api/v1_0/warehouses/restore/{id}'",
        * operationId="restoreWarehouseById",
        * tags={"warehouse"},
        * summary="restore warehouse By Id",
        * description="restore warehouse By Id Here",
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
    public function restoreByLocationId(RestoreLocationRequest $request,$id)
    {
        return $this->locationService->restore($id);
    }
/**
        * @OA\put(
        * path="/api/v1_0/warehouses/verfied'",
        * operationId="verfiedWarehouse",
        * tags={"warehouse"},
        * summary="verfied warehouse",
        * description="verfied warehouse",
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
    public function verfiedLocation(VerfiedLocationRequest $request)
    {
        return $this->locationService->verfied($request);
    }
}
