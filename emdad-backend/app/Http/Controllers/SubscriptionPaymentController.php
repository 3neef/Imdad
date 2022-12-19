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
     *    path="/api/v1_0/profiles/subscriptionPayment",
     *    operationId="create-subscriptionPayment",
     *    tags={"Profile Controller"},
     *    summary="create subscriptionPayment",
     *    description="create subscriptionPayment",
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
     *  *     @OA\RequestBody(
        *         @OA\JsonContent(),
        *         @OA\MediaType( 
        *            mediaType="multipart/form-data",
        *            @OA\Schema(
        *               type="object",
        *               required={"subscriptionpyment_id","type"},
        *               @OA\Property(property="subscriptionpyment_id", type="integer"),
        *            ),
        *        ),
        *    ),
     *    @OA\Response(
     *         response=200,
     *         description="",
     *         @OA\JsonContent(
     *         @OA\Property(property="subscriptionId", type="integer", example="{' 'id': 1, 'compnay_id': '1','subscription_id': 1, 'user_id': 1, 'sub_total': 13.0, 'days': 30,'tax_amount':15,'total':28.0}")
     *          ),
     *       )
     *      )
     *  )
     */
    public function store(SubscriptionPaymentRequest $request)
    {
        return $this->subscriptionPaymentService->store($request);
    }
}
