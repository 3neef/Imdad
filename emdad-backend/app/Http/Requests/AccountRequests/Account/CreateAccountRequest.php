<?php

namespace App\Http\Requests\AccountRequests\Account;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Accounts\CompanyInfo;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateAccountRequest extends FormRequest
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
            'name' => ['required','string','max:100','unique:company_info,name'],
            'companyId' => ['required','string','max:25','unique:company_info,company_id'],
            'companyType' => ['required','integer','between:0,2'],
            'companyVatId' => ['required','string','max:25','unique:company_info,company_vat_id'],
            'contactName' => ['required','string','max:100'],
            'contactPhone' => ['required','string','max:15','min:15','regex:/^(00966)/'],
            'contactEmail' => ['required','email','max:100']
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException( response()->json(["errors"=>$validator->errors()],422));
    }
}
