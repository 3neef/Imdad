<?php

namespace App\Http\Controllers\Accounts;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AccountRequests\Subscription\UpdateSubscriptionRequest;
use App\Http\Services\AccountServices\SubscriptionService;

class SubscriptionController extends Controller
{
    protected SubscriptionService $subscriptionService;

    /**
     * Create a new controller instance.
     *
     * @param  App\Http\Services\AccountServices\SubscriptionService  $subscriptionService
     * @return void
     */
    public function __construct(SubscriptionService $subscriptionService)
    {
        $this->subscriptionService = $subscriptionService;
    }
/**
        * @OA\put(
        * path="/api/v1_0/subscriptions/update",
        * operationId="update-sub-packages",
        * tags={"Platform Settings"},
        * summary="update Subscription packages if update old flag is set true all presubscribed companies subscription details will be overwriteen",
        * description="update Subscription",
        *     @OA\RequestBody(
        *         @OA\JsonContent(),
        *         @OA\MediaType(
        *            mediaType="multipart/form-data",
        *            @OA\Schema(
        *               type="object",
        *               required={"id","updateOld","subscriptionDetails","subscriptionDetails.superAdmin"},
        *               @OA\Property(property="id", type="integer"),
        *                @OA\Property(property="updateOld", type="boolean"),
        *                @OA\Property(property="subscriptionDetails", type="integer"),
        *                @OA\Property(property="subscriptionDetails.superAdmin", type="integer")
        *            ),
        *        ),
        *    ),
        *      @OA\Response(
        *        response=200,
        *          description="updated successfully",
        *       ),
        *      @OA\Response(response=404, description="Resource Not Found"),
        *      @OA\Response(response=422, description="Validation error"),
        *      @OA\Response(response=500, description="system error")
        * )
        */
    public function updateSubscription(UpdateSubscriptionRequest $request)
    {
        return $this->subscriptionService->update($request);
    }
}
