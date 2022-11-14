<?php

namespace App\Http\Services\CouponServices;

use App\Models\Coupon\Coupon;
use App\Models\SubscriptionPayment;
use GuzzleHttp\Psr7\Request;
use Carbon\Carbon;

class CouponServices
{

    public function createCoupon($request)
    {
            $coupon = Coupon::create([
                'allowed' => $request->allowed,
                'start_date' => $request->stratDate,
                'end_date' => $request->endDate,
                'value' => $request->value,
                'is_percentage' => $request->isPercentage,
                'code' => random_int(100000,999999),
            ]);
            return response()->json(['message' => 'coupon created successfully'],200);

    }

    public function showCoupon(){
        $couponCode = Coupon::where('end_date','>',Carbon::now())->get();
        return  response()->json(['data' => $couponCode],200);
    }

     public function usedCoupon($request)
    {
        $coupon = Coupon::where('code',$request->code)->first();
        $subscription = SubscriptionPayment::where('id',$request->subscriptionpayment_id)->first();
        if($coupon->end_date > Carbon::now() && $coupon->allowed > $coupon ->used){
            $coupon->update(['used'=>$coupon->used + 1]);
            // if($coupon->is_percentage==1){
            //     $total =
            // }
            $subscription->update([
                'coupon_id'=>$coupon->id,
                'discount'=>$coupon->value,
                'total'=>$subscription->total-$coupon->value,
            ]);

            return response()->json(['data'=>$subscription,'message' => 'aproved successfully'], 200);
        }
        else{
            return response()->json(['message' => 'can,t use coupon'], 301);
        }
    }
}
