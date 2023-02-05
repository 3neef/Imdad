<?php

namespace App\Http\Services\General;

use App\Models\AppSetting;

class SmsService
{

  public   function sendOtp($user)
  {

    # code...
    // $msgBody = "Your verification code is " . $user->otp;
    // sendSms($mobile, $msgBody);
    // $this->sendSms($user->mobile, $msgBody);
  }

  public  function sendSms($mobile, $var,$smsType='otp')
  {
    $template_id=null;
    if($smsType==='otp'){
      $msgBody = 'Your verification code is ' . $var.'';
      $template_id=AppSetting::where("key","sms_otp_en")->frist()?AppSetting::where("key","sms_otp_en")->frist()->value:null;

    } 
    if($smsType=='password'){
      $msgBody = 'Emdad account has been issued for you use this first time password ' . $var.'';
      $template_id=AppSetting::where("key","sms_otp_en")->frist()?AppSetting::where("key","sms_password_en")->frist()->value:null;

    }


    // dd([$mobile,urlencode($msgBody)]);

    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://rest.gateway.sa/api/SendSMS?api_id=API8853343069&api_password=Govb6nG0um&sms_type=T&sender_id=Emdad-Aid&phonenumber=' . $mobile . '&textmessage=' . urlencode($msgBody) . '&encoding=U&template_id='.$template_id,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    // dd( $response);
  }
}
