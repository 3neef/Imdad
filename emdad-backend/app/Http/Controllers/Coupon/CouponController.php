<?php
namespace App\Http\Controllers\Coupon;
use App\Http\Controllers\Controller;
use App\Http\Requests\CouponRequests\CreateCouponRequest;
use App\Http\Services\CouponServices\CouponServices;

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



    public function showCoupon()
    {
        return $this->couponService->showCoupon();
    }

public function usedCoupon($coupon)
{
    return $this->couponService->usedCoupon($coupon);
}

}
