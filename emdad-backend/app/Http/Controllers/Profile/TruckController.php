<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\AccountRequests\Truck\CreateTruckRequest;
use App\Http\Services\AccountServices\TruckService;
use Illuminate\Http\Request;

class TruckController extends Controller
{
    protected TruckService $truckservice ;

    public function __construct( TruckService $truckservice )
 {

        $this->truckservice = $truckservice;
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->truckservice->index();
    }

   /**
        * @OA\Post(
        * path="/api/v1_0/trucks",
        * operationId="createtrucks",
        * tags={"Department"},
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
        *
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
        * path="/api/v1_0/trucks",
        * operationId="trucks",
        * tags={"warehouse"},
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

    public function update(Request $request,$id)
    {
        return $this->truckservice->update($request , $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        return $this->truckservice->delete($id);
    }



    public function restoretruck($id)
    {
        return $this->truckservice->restore($id);
    }
}
