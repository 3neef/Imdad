<?php

namespace App\Http\Services;

use App\Http\Resources\Subscription\SubscriptionResource;
use App\Http\Services\General\UrwayGateway;
use App\Models\Accounts\SubscriptionPackages;
use App\Models\Profile;
use App\Models\SubscriptionPayment;
use App\Models\User;
use Carbon\Carbon;
use Exception;

class SubscriptionPaymentService
{

    public function store($request)
    {

        $dt = new Carbon();

        $user = User::where('id', auth()->id())->first();

        $subscription = SubscriptionPackages::where('id', $request->packageId)->first();

        $payedSubscription = SubscriptionPayment::where('profile_id', auth()->user()->profile_id)->first();
        $oldOwner = $user->oldOwner();

        $price = $oldOwner == true ? $subscription->price_2 : $subscription->price_1;


        if ($payedSubscription == null ||  Carbon::now() > $payedSubscription->expire_date) {


            $SubscriptionPayment = SubscriptionPayment::create([
                'profile_id' => auth()->user()->profile_id,
                'package_id' => $request->packageId,
                'user_id' => auth()->id(),
                'sub_total' => $price,
                'expire_date' => $dt->addYear(),
                'tax_amount' => $price * 15 / 100,
                'total' => ($price + ($price * 15 / 100)),
                'status'=>$price>0?"Pending":"Paid"

            ]);
            $user->profile()->update(['subs_id' => $request->packageId, 'subscription_details' => $subscription->features],200);

            return response()->json(['data' => new SubscriptionResource($SubscriptionPayment), "oldOwner" => $oldOwner,"statusCode"=>"000"], 200);
        } else {

            if ($payedSubscription->status === 'Pending') {
                $payedSubscription->update([
                    'package_id' => $request->packageId,
                    'user_id' => auth()->id(),
                    'sub_total' => $price,
                    'expire_date' => $dt->addYear(),
                    'tax_amount' => $price * 15 / 100,
                    'total' => ($price + ($price * 15 / 100)),
                ]);
                $user->profile()->update(['subs_id' => $request->packageId, 'subscription_details' => json_encode($subscription->features, true)]);

                return response()->json(['data' => new SubscriptionResource($payedSubscription), "oldOwner" => $oldOwner,'statusCode'=>"000"], 200);
            }
        }
        return response()->json(['success' => false, "error" => "you  have ALready  Active Subscriptions ",'statusCode'=>'511'], 200);
    }


    public function check_subscription_payment()
    {
        $status = SubscriptionPayment::where('profile_id', auth()->user()->profile_id)->pluck('status')->first();
        if ($status) {
            return response()->json(['status' => $status], 200);
        } else {
            return response()->json(['message' => 'error','statusCode'=>'999'], 200);
        }
    }




    public function delete($id)
    {
        $subscription = SubscriptionPayment::find($id)->first();

        $deleted = $subscription->delete();

        if ($deleted) {
            return response()->json(['message' => 'deleted successfully','statusCode'=>'112'], 200);
        }
        return response()->json(['error' => 'system error','statusCode'=>'999'], 200);
    }

    public function pay()
    {
        # code...
        $user = User::where("id", auth()->id())->first();
        $profile = Profile::where("id", $user->profile_id)->first();
        $paymentRequest = SubscriptionPayment::where("profile_id", $profile->id)->where("status", "Pending")->first();
        if ($paymentRequest == null) {
            return response()->json(['error' => 'system error','statusCode'=>'111'], 200);
        }
        $request = ["transId" => $paymentRequest->id, "trackId" => $paymentRequest->id, "amount" => $paymentRequest->total, 'email' => $user->email];
        try {
            $response = UrwayGateway::initPayment($request);
            $json = json_decode($response, true);
            $paymentRequest->update(['tx_id' => $json['payid']]);
            return response()->json(['data' => new SubscriptionResource($paymentRequest),'statusCode'=>"000"], 200);
        } catch (Exception $e) {

            return response()->json(['success' => $json['result'], 'message' => $json["reason"], 'statusCode' => $json['responseCode']], 402);
        }
    }

    public function checkPaymentStatus()
    {
        $user = User::where("id", auth()->id())->first();
        $profile = $user->currentProfile();
        $paymentRequest = SubscriptionPayment::where("profile_id", $profile->id)->first();
        if($paymentRequest==null){
            dd('sdssdd');
            return response()->json(['message' =>"you have not selected any package yet","statusCode"=>"111"], 200);

        }
        if ($paymentRequest->status == "Paid") {
            return response()->json(['data' => new SubscriptionResource($paymentRequest),"statusCode"=>"000"], 200);
        }
        if ($paymentRequest->status == "Pending") {
            $request = ["transId" => $paymentRequest->tx_id, "trackId" => $paymentRequest->id, "amount" => $paymentRequest->total, 'email' => $user->email];
            try {
                $response = UrwayGateway::getPaymentStatus($request);
                $json = json_decode($response, true);
                if ($json['responseCode'] == 000 && $json['result'] == "Successful") {
                    $paymentRequest->update(['status' => 'Paid']);
                    return response()->json(['data' => new SubscriptionResource($paymentRequest),"statusCode"=>"000"], 200);
                }
            } catch (Exception $e) {

                return response()->json(['success' => $json['result'], 'message' => $json["reason"], 'statusCode' => $json['responseCode']], 200);
            }
        }
    }
}
