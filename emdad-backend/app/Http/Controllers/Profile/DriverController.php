<?php

namespace App\Http\Controllers\Profile;

use App\Http\Collections\DriverCollection;
use App\Http\Controllers\Controller;
use App\Http\Requests\Driver\CreateDriverRequest;
use App\Http\Services\AccountServices\DriverService;
use App\Models\Accounts\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DriverService $driverService)
    {
        return DriverCollection::collection();
    }

   /**
        * @OA\Post(
        * path="/api/v1_0/drivers",
        * operationId="createdrivers",
        * tags={"Delivery"},
        * summary="create drivers ",
        * description="create trucks  Here",
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
        *               required={"nameAr","nameEn","age","phone","nationality"},
        *               @OA\Property(property="nameAr", type="string"),
        *               @OA\Property(property="nameEn", type="string"),
        *               @OA\Property(property="age", type="integer"),
        *               @OA\Property(property="phone", type="string"),
        *               @OA\Property(property="nationality", type="string"),
        *            ),
        *        ),
        *    ),
        *      @OA\Response(
        *          response=200,
        *          description="driver created Successfully"
        *       ),
        *      @OA\Response(response=404, description="Resource Not Found"),
        * )
        */
    public function store(CreateDriverRequest $request, DriverService $driverService)
    {
        return $driverService->store($request);
    }

/**
        * @OA\get(
        * path="/api/v1_0/drivers/{id}'",
        * operationId="getdriversById",
        * tags={"delivery"},
        * summary="get driver By Id",
        * description="get driver By Id Here",
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
        *          description="get driver By Id",
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
    public function show(DriverService $driverService, $id)
    {
        return $driverService->show($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

 /**
        * @OA\put(
        * path="/api/v1_0/drivers",
        * operationId="update-drivers",
        * tags={"delivery"},
        * summary="update drivers",
        * description="update driver Here",
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
        *          description="updated Successfully",
        *          @OA\JsonContent(),
        *          @OA\MediaType(
        *            mediaType="multipart/form-data",
        *            @OA\Schema(
        *               type="object",
        *               @OA\Property(property="nameAr", type="string"),
        *               @OA\Property(property="nameEn", type="string"),
        *               @OA\Property(property="age", type="integer"),
        *               @OA\Property(property="phone", type="string"),
        *               @OA\Property(property="nationality", type="string"),
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
    public function update(Request $request, $id, DriverService $driverService)
    {
        return $driverService->update($request, $id);
    }

    /**
     * @OA\delete(
     * path="/api/v1_0/drivers",
     * operationId="delete-drivers",
     * tags={"delivery"},
     * summary="Delete drivers",
     * description="delete driver here",
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
     *          response=301,
     *          description="driver deleted successfully",
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
    public function destroy($id, DriverService $driverService)
    {
        return $driverService->destroy($id);
    }
/**
        * @OA\put(
        * path="/api/v1_0/drivers/restore/{id}'",
        * operationId="restoredriverkById",
        * tags={"trucks"},
        * summary="restore driver By Id",
        * description="restore driver By Id Here",
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
        *          description="restore driver By Id",
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
    public function restore($id, DriverService $driverService)
    {
        return $driverService->restore($id);
    }
}
