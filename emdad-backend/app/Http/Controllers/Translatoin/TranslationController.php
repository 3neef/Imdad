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


    public function create( TranslateRequest $request )
    {
           return $this->TranslationService->create( $request );
       }

}
