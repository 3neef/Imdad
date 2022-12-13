<?php

namespace App\Http\Requests\AccountRequests\Account;

use Dotenv\Validator;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class AddMoreCompanyRequest extends FormRequest
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
            'crNo' => ['required','exists:related_companies,cr_number'],
            'roleId' => ['required','integer','exists:roles,id'],
            'PrfoileType' => ['required',Rule::in('Buyer','suppiler')],
           
        ];
    }

    protected function failedValidation(ValidationValidator $validator): void
    {
        throw new HttpResponseException( response()->json(["success"=>false,"errors"=>$validator->errors()],422));
    }
}
