<?php
namespace App\Http\Services\General;


class SmsService{

public function sendSms($request)
{
    $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://rest.gateway.sa/api/SendSMS?api_id=API8853343069&api_password=Govb6nG0um&sms_type=T&sender_id=Emdad-Aid&phonenumber='.$request->mobile.'&textmessage='.$request->msgBody.'&encoding=U',
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
echo $response;
}
}