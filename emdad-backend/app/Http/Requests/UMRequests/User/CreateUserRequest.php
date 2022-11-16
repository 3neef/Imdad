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
            'first_name' => ['required','string','max:100'],
            'companyName' => ['string','max:100'],
            'last_name' => ['required','string','max:25'],
            'identity_number' => ['required','string','max:25'],
            'identity_type' => ['required'],
            'mobile' => ['required','string','max:14','min:14','regex:/^(00249)/','unique:users,mobile'],
            'email' => ['required','email','max:100','unique:users,email'],
        ];
        if ($this->path() == 'api/users/createUser') {
            $rules = [
                "firstName"=>"required|string|max:50|unique:users",
                "lastName"=>"required|string|max:50|unique:users",
                "email"=>"required|email|string|max:255",
                "mobile"=>"required|min:9|max:14|string",
                "roleId"=> "required|integer|exists:roles,id",
                "lang" => Rule::in("en", "ar"),
            ];
        }
        return $rules;
    }


    // protected function passedValidation()
    // {
    //     $requestData=[];
    //     $requestData['company_id']=$this["companyId"];
    //     $requestData['name']=$this["name"];
    //     $requestData['mobile']=$this["mobile"];
    //     $requestData['role_id']=$this["roleId"];
    //     $requestData['company_id']=$this["companyId"];
    //     return $requestData;
    // }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(response()->json(["errors" => $validator->errors()], 422));
    }
}
