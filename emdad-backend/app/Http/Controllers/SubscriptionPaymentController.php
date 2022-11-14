<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscriptionPaymentRequest;
use App\Http\Services\SubscriptionPaymentService;
use Illuminate\Http\Request;

class SubscriptionPaymentController extends Controller
{
    protected SubscriptionPaymentService $subscriptionPaymentService;

    public function __construct(SubscriptionPaymentService $subscriptionPaymentService)
    {
        $this->subscriptionPaymentService = $subscriptionPaymentService;
    }

        /**
     * @OA\get(
     *    path="/api/v1_0/accounts/subscriptionPayment",
     *    operationId="create subscriptionPayment",
     *    tags={"Accounts"},
     *    summary="create subscriptionPayment",
     *    description="create subscriptionPayment",
     *    @OA\Response(
     *         response=200,
     *         description="",
     *         @OA\JsonContent(
     *         @OA\Property(property="subscription_id", type="integer", example="{' 'id': 1, 'compnay_id': '1','subscription_id': 1, 'user_id': 1, 'sub_total': 13.0, 'days': 30,'tax_amount':15,'total':28.0}")
     *          ),
     *       )
     *      )
     *  )
     */
    public function AddSubscriptionPayment(SubscriptionPaymentRequest $request)
    {
        return $this->subscriptionPaymentService->addSubscriptionPayment($request);
    }
}
