<?php
namespace App\Http\Controllers\Coupon;
use App\Http\Controllers\Controller;
use App\Http\Requests\CouponRequests\CreateCouponRequest;
use App\Http\Services\CouponServices\CouponServices;
use GuzzleHttp\Psr7\Request;

class CouponController extends Controller
{

    protected CouponServices $couponService;

    public function __construct(CouponServices $couponService)
    {
        $this->couponService = $couponService;
    }
/**
        * @OA\Post(
        * path="/api/v1_0/coupon/create",
        * operationId="createCoupon",
        * tags={"Coupon"},
        * summary="create Coupon",
        * description="create Coupon Here",
        *     @OA\RequestBody(
        *         @OA\JsonContent(),
        *         @OA\MediaType(
        *            mediaType="multipart/form-data",
        *            @OA\Schema(
        *               type="object",
        *               required={"allowed","stratDate","endDate","value","isPercentage"},
        *               @OA\Property(property="allowed", type="integer"),
        *               @OA\Property(property="stratDate", type="date_format:Y/m/d"),
        *               @OA\Property(property="endDate", type="date_format:Y/m/d"),
        *               @OA\Property(property="value", type="integer"),
        *               @OA\Property(property="isPercentage", type="boolean")
        *            ),
        *        ),
        *    ),
        *      @OA\Response(
        *        response=200,
        *        description="created Successfully"),
        *      @OA\Response(response=500, description="system error"),
        *      @OA\Response(response=422, description="Validate error"),
        *      @OA\Response(response=404, description="Resource Not Found"),
        * )
*/
    public function createCoupon(CreateCouponRequest $request)
    {
        return $this->couponService->createCoupon($request);
    }

 /**
     * @OA\get(
     *    path="/api/v1_0/coupon/show",
     *    operationId="showallcoupons",
     *    tags={"Coupon"},
     *    summary="show all  coupons",
     *    description="show all  coupons Here",
     *    @OA\Response(
     *         response=200,
     *         description="",
     *         @OA\JsonContent(
     *         @OA\Property(property="Maincatogre", type="integer", example="{'id': 1, 'code': 1234567 ,'used': 0, 'allowed': 1, 'startdate': 2022-1-1, 'enddate': 2022-2-1}")
     *          ),
     *       )
     *      )
     *  )
     */

    public function showCoupon()
    {
        return $this->couponService->showCoupon();
    }



  /**
        * @OA\put(
        * path="/api/v1_0/coupon/used/{coupon}",
        * operationId="usedcoupon",
        * tags={"Coupon"},
        * summary="used Coupon ",
        * description=" used Coupon Here",
        *     @OA\RequestBody(
        *         @OA\JsonContent(),
        *         @OA\MediaType(
        *            mediaType="multipart/form-data",
        *            @OA\Schema(
        *               type="object",
        *               required={"code","subscriptionpayment_id"},
        *               @OA\Property(property="code", type="integer"),
        *               @OA\Property(property="subscriptionpayment_id", type="integer")
        *            ),
        *        ),
        *    ),
        *      @OA\Response(
        *          response=200,
        *          description="coupon used Successfully"
        *       ),
        *      @OA\Response(response=404, description="Resource Not Found"),
         *      @OA\Response(response=301, description="can,t use coupon")
        * )
        */

public function usedCoupon(Request $request)
{
    return $this->couponService->usedCoupon($request);
}

}
