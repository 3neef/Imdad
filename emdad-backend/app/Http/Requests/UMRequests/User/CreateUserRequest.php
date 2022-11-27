<?php

namespace App\Http\Requests\UMRequests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class CreateUserRequest extends FormRequest
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
            'firstName' => ['required','string','max:100'],
            'lastName' => ['required','string','max:25'],
            'identityNumber' => ['unique:users,identity_number','required','string','max:25'],
            'identityType' => ['required'],
            'mobile' => ['unique:users,mobile','required','string','max:14','min:14','regex:/^(00249)/',],
            'email' => ['unique:users,email','required','email','max:100',],
            "roleId"=> "|integer|exists:roles,id",
            'password'=>'required|string',
            'expireDate'=>'required|date',
        ];

        return $rules;
    }



    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(response()->json(["success"=>false,"errors" => $validator->errors()], 422));
    }
}
