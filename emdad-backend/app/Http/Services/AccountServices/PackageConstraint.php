<?php

namespace App\Http\Services\AccountServices;

use App\Models\SubscriptionPayment;
use Carbon\Carbon;
use Exception;

class PackageConstraint
{

    public function parsePackageFeatures()
    {
        $checkResposne = $this->checkPackageValidity();
        $features = null;
        if ($checkResposne['success']) {
            $features = json_encode($checkResposne['package']);
        }
        $features = [];
        return $features;
    }

    public function checkPackageValidity()
    {
        $subscirptionPayment = null;
        try {
            $subscirptionPayment = auth()->user()->currentProfile->subscriptionPayments()->latest();
            if ($subscirptionPayment->expire_date < Carbon::now()) {
                // package subscription is valid return package with success true
                return ["success" => true, "package" => auth()->user()->currentProfile->subscription_details];
            } else {
                // package subscription is not valid return package with success false

                return ["success" => false, "package" => auth()->user()->currentProfile->subscription_details];
            }
        } catch (Exception $ex) {
            return ["success" => "false", "package" => null];
        }
    }
}
