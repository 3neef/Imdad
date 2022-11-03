<?php

namespace App\Http\Controllers;

use App\Http\Requests\General\SendSmsRequest;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class SmsController extends Controller
{
    

    
/**
        * @OA\Get(
        * path="/api/v1_0/sendSms",
        * operationId="send-sms",
        * tags={"System api and external integration"},
        * summary="send sms ",
        * description="send sms",
        *     @OA\RequestBody(
        *         @OA\JsonContent(),
        *         @OA\MediaType(
        *            mediaType="multipart/form-data",
        *            @OA\Schema(
        *               type="object",
        *               required={"mobile","msgBody"},
        *               @OA\Property(property="mobile", type="string"),
        *               @OA\Property(property="msgBody", type="string"),
        *            ),
             
        *        ),
        
        *    ),
        *      @OA\Response(
        *          response=200,
   * description="sent successfully"
        *       ),
     
        *      @OA\Response(response=404, description="Resource Not Found"),
        * )
        */
    public function sendSms(SendSmsRequest $request)
    {
        # code...

        
        $client = new Client();
        $res = $client->request('GET', 'https://rest.gateway.sa/api/SendSMS', [
            'form_params' => [
                'api_id' => 'API8853343069',
                'api_password' => 'Govb6nG0um',
                'sms_type' => 'T',
                'sender_id' => 'Emdad-Aid',
                'client_id' => 'test_id',
                'phonenumber' => $request->mobile,
                'textmessage' => $request->msgBody,
               
            ]
        ]);
        if($res->getStatusCode()==200){
            return response()->json(["success"=>true,"message"=>"sent successfully"],200);
        }
    }
}
