<?php

namespace App\Http\Services\Translation;

use App\Models\Translation;

class TranslationService
{
    public function create($request)
    {

            $translate = Translation::create([
                'key' => $request->key,

                'en_value' => $request->en_value,

                'ar_value' => $request->ar_value,
            ]);

            if ($translate) {
                return response()->json(['message' => 'created successfully'], 200);
            }
            return response()->json(['error' => 'system error'], 500);
        }




        
    }




