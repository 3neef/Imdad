<?php

namespace App\Http\Requests\AccountRequests\Account;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateAccountRequest extends FormRequest
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
            'id' => ['required','integer','exists:company_info,id'],
            'name' => ['string','max:100','unique:company_info,name'],
            'companyId' => ['string','max:25','unique:company_info,company_id'],
            'companyType' => ['integer','max:1','min:1','between:0,2'],
            'companyVatId' => ['string','max:25','unique:company_info,company_vat_id'],
            'contactName' => ['string','max:100'],
            'contactPhone' => ['max:15','min:15','regex:/^(00966)/'],
            'contactEmail' => ['email','max:100']
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException( response()->json(["errors"=>$validator->errors()],422));
    }
}
