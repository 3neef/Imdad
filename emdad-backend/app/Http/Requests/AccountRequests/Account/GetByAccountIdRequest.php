<?php

namespace App\Http\Requests\AccountRequests\Account;

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
        $id = $this->id == null ? "1" : $this->id;
        $rules =['id' => ['required','integer','exists:company_info,id']];
        if($this->isMethod('delete')){
            $rules =['id' => ['required','integer','exists:company_info,id',new CheckUserAssingCompany]];
        }elseif($this->path() == 'api/accounts/validate/'.$id.''){
            $rules =['id' => ['required','integer','exists:company_info,id,is_validated,0']];
        }
        return $rules;
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException( response()->json(["errors"=>$validator->errors()],422));
    }
}
