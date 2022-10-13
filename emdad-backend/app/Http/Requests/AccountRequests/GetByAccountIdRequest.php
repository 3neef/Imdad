<?php

namespace App\Http\Requests\AccountRequests;

use App\Rules\CheckUserAssingCompany;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class GetByAccountIdRequest extends FormRequest
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

    protected function prepareForValidation() 
    {
        $this->merge(['id' => $this->route('id')]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules =['id' => ['required','integer','exists:company_infos,id']];
        if($this->isMethod('delete')){
            $rules =['id' => ['required','integer','exists:company_infos,id',new CheckUserAssingCompany]];
        }
        return $rules;
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException( response()->json(["errors"=>$validator->errors()],422));
    }
}