<?php

namespace App\Http\Requests\UMRequests\User;

use App\Rules\UniqeValues;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class StoreAuthRequest extends FormRequest
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
        $rules = [
            'fullName' => ['required','string','max:100'],
            'identityNumber' => ['unique:users,identity_number','required','string','max:25'],
            'identityType' => ['string'],
            'mobile' => ['unique:users,mobile','required','string','max:14','min:14','regex:/^(00966)/',],
            'email' => ['unique:users,email','required','email','max:100',],
            "roleId"=> "|integer|exists:roles,id",
            'password'=>'required|string|min:8',
            'expireDate'=>'required|date',
            'permissions'=>['array',new UniqeValues],
            'permissions.*'=>['string','exists:permissions,label'],
            'is_learning'=>['boolean'],

        ];
        // dd($this->all());

        return $rules;
    }



    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(response()->json(["success"=>false,"errors" => $validator->errors()], 422));
    }
}