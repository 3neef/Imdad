<?php

namespace App\Http\Requests\General;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class SendSmsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'mobile' => ['required','string','max:15','min:15','regex:/^(00966)/'],
            'body'=>['required','max:500'],

         
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException( response()->json(["errors"=>$validator->errors()],422));
    }
}
