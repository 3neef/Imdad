<?php

namespace App\Http\Controllers\Accounts;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AccountRequests\Subscription\UpdateSubscriptionRequest;
use App\Http\Services\AccountServices\SubscriptionService;

class SubscriptionController extends Controller
{
    protected $subscriptionService;
 
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

    public function updateSubscription(UpdateSubscriptionRequest $request)
    {
        return $this->subscriptionService->update($request);
    }
}
