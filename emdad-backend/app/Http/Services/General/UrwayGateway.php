<?php

namespace App\Http\Services\General;

use App\Models\Emdad\RelatedCompanies;

use function PHPUnit\Framework\isEmpty;

class UrwayGateway
{
    public function initPayment($request)
    {

        $curl = curl_init();
        $txn_details=
        $request->trackId."|".env('TERMINAL_ID')."|".env('TERMINAL_PASS')."|".env('PAYMENT_SEC_KEY')."|".$request->amount."|SAR";
        $hash=hash('sha256', $txn_details);
        curl_setopt_array($curl, array(
          CURLOPT_URL => env('PAYMENT_URL'),
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>'
        {
        "transid": '.$request->transId.',
        "trackid": '.$request->trackId.',
        "terminalId": '.env('TERMINAL_ID').',
        "action": "1",
        "customerEmail" :'.$request->customerEmail.',
        "merchantIp": "10.10.10.101",
        "password":'.env('TERMINAL_PASS').',
        "country":"Saudi Arabia",
        "currency": "SAR",
        "amount":'.$request->amount.',
        "requestHash":'.$hash.'
        }',
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
          ),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
       
       return $response;
    }
}
