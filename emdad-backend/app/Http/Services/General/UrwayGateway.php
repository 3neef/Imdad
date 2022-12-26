<?php

namespace App\Http\Services\General;

use App\Models\Emdad\RelatedCompanies;

use function PHPUnit\Framework\isEmpty;

class UrwayGateway
{
  public  static function initPayment($request)
  {
    $curl = curl_init();
    $txn_details = $request['trackId'] . "|" . "emdad" . "|" . "Urway@123" . "|" . "82e729239a7f199ffe10ebf53c4ec41a59d34dc149f41a0d24776a9e4d3e1c38" . "|" . $request['amount'] . "|SAR";
    $hash = hash('sha256', $txn_details);
    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://payments-dev.urway-tech.com/URWAYPGService/transaction/jsonProcess/JSONrequest",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => '
      {
      "transid": ' . $request['transId'] . ',
      "trackid": ' . $request['trackId'] . ',
      "terminalId": "emdad",
      "action": "1",
      "udf2":"https://172.21.1.116:8080/payment",
      "customerEmail" : "'.$request['email'].'",
      "merchantIp": "10.10.10.101",
      "password": "Urway@123",
      "country":"Saudi Arabia",
      "currency": "SAR",
      "amount": ' . $request['amount'] . ',
      "requestHash":"' . $hash . '"
      }',
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
      ),
    ));

    $response = curl_exec($curl);
    // dd($response);

    curl_close($curl);

    return $response;
  }

  public  static function getPaymentStatus($request)
  {
    $curl = curl_init();
    $txn_details = $request['trackId'] . "|" . "emdad" . "|" . "Urway@123" . "|" . "82e729239a7f199ffe10ebf53c4ec41a59d34dc149f41a0d24776a9e4d3e1c38" . "|" . $request['amount'] . "|SAR";
    $hash = hash('sha256', $txn_details);
    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://payments-dev.urway-tech.com/URWAYPGService/transaction/jsonProcess/JSONrequest",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => '
      {
      "transid": ' . $request['transId'] . ',
      "trackid": ' . $request['trackId'] . ',
      "terminalId": "emdad",
      "action": "10",
      "customerEmail" : "' . $request['email'] . '",
      "merchantIp": "10.10.10.101",
      "password": "Urway@123",
      "country":"Saudi Arabia",
      "currency": "SAR",
      "udf1": "1",
      "amount": ' . $request['amount'] . ',
      "requestHash":"' . $hash . '"
      }',
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    return $response;
  }
}
