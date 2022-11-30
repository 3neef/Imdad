<?php

namespace App\Http\Controllers\Translatoin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Translation\TranslateRequest;
use App\Http\Services\Translation\TranslationService;
use Illuminate\Http\Request;

class TranslationController extends Controller
{

    protected TranslationService $TranslationService ;

    public function __construct( TranslationService $TranslationService )
 {

        $this->TranslationService = $TranslationService;
    }

/**
        * @OA\Post(
        * path="/api/v1_0/translation/create",
        * operationId="translation create",
        * tags={"Translation"},
        * summary="translation create",
        * description="translation create Here",
        *     @OA\RequestBody(
        *         @OA\JsonContent(),
        *         @OA\MediaType(
        *            mediaType="multipart/form-data",
        *            @OA\Schema(
        *               type="object",
        *               required={"key","en_value","ar_value"},
        *               @OA\Property(property="key", type="string"),
        *               @OA\Property(property="en_value", type="string"),
        *               @OA\Property(property="ar_value", type="string")
        *            ),
        *        ),
        *    ),
        *      @OA\Response(
        *        response=200,
        *          description="created Successfully"
        *       ),
        *      @OA\Response(response=404, description="Resource Not Found"),
         *      @OA\Response(response=500, description="system error")
        * )
        */
    public function create( TranslateRequest $request )
    {
           return $this->TranslationService->create( $request );
       }

}
