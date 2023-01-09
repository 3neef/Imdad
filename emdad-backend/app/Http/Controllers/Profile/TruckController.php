<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\AccountRequests\Truck\CreateTruckRequest;
use App\Http\Requests\Driver\SuspendRequest;
use App\Http\Services\AccountServices\TruckService;
use App\Models\Accounts\Truck;
use Illuminate\Http\Request;

class TruckController extends Controller
{
    protected TruckService $truckservice;
    

    public function __construct(TruckService $truckservice)
    {

        $this->truckservice = $truckservice;
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\get(
     * path="/api/v1_0/trucks",
     * operationId="gettrucks",
     * tags={"trucks"},
     * summary="get trucks",
     * description="get all trucks Here",
     *     @OA\Parameter(
     *         name="x-authorization",
     *         in="header",
     *         description="Set x-authorization",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *      @OA\Response(
     *          response=200,
     *          description="get all trucks",
     *          @OA\JsonContent(),
     *          @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *            ),
     *        ),
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity",
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */

    public function index(Request $request)
    {
        return $this->truckservice->index($request);
    }

    /**
     * @OA\Post(
     * path="/api/v1_0/trucks",
     * operationId="createtrucks",
     * tags={"trucks"},
     * summary="create trucks ",
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
     *               required={"name","type","class","color","model","size","brand","image"},
     *               @OA\Property(property="name", type="string"),
     *               @OA\Property(property="type", type="string"),
     *               @OA\Property(property="class", type="string"),
     *               @OA\Property(property="color", type="string"),
     *               @OA\Property(property="model", type="string"),
     *               @OA\Property(property="size", type="string"),
     *               @OA\Property(property="brand", type="string"),
     *               @OA\Property(property="image", type="file")
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
    public function store(CreateTruckRequest $request)
    {
        $this->authorize('create', Truck::class);
        return $this->truckservice->store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * @OA\put(
     * path="/api/v1_0/trucks/{id}",
     * operationId="update-trucks",
     * tags={"trucks"},
     * summary="update trucks",
     * description="update Depatrucksrtment Here",
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
     *               @OA\Property(property="name", type="string"),
     *               @OA\Property(property="type", type="string"),
     *               @OA\Property(property="class", type="string"),
     *               @OA\Property(property="color", type="string"),
     *               @OA\Property(property="model", type="string"),
     *               @OA\Property(property="size", type="string"),
     *               @OA\Property(property="brand", type="string"),
     *               @OA\Property(property="image", type="file"),
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

    public function update(Request $request, $id)
    {
        $this->authorize('update', Truck::class);

        return $this->truckservice->update($request, $id);
    }

    /**
     * @OA\put(
     * path="/api/v1_0/trucks/suspend/{id}",
     * operationId="suspend-trucks",
     * tags={"trucks"},
     * summary="suspend/activate trucks",
     * description="suspend or activate trucks Here",
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
     *               @OA\Property(property="status", type="string"),
     *            ),
     *        ),
     *
     *       ),
     *      @OA\Response(response=500, description="system error"),
     *      @OA\Response(response=422, description="Validate error"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */

    public function suspend(SuspendRequest $request, $id)
    {
        $this->authorize('update', Truck::class);

        return $this->truckservice->suspend($request, $id);
    }

    /**
     * @OA\delete(
     * path="/api/v1_0/trucks/{id}",
     * operationId="delete-trucks",
     * tags={"trucks"},
     * summary="Delete trucks",
     * description="delete trucks here",
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
     *          description="truck deleted successfully",
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
    public function destroy($id)
    {
        $this->authorize('delete', Truck::class);
        return $this->truckservice->delete($id);
    }

    /**
     * @OA\put(
     * path="/api/v1_0/trucks/restore/{id}",
     * operationId="restoretruckById",
     * tags={"trucks"},
     * summary="restore truck By Id",
     * description="restore truck By Id Here",
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

    public function restoretruck($id)
    {
        return $this->truckservice->restore($id);
    }
}
