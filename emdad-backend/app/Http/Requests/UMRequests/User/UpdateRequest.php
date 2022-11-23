<?php

namespace App\Http\Requests\UMRequests\User;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateRequest extends FormRequest
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
            "firstName"=>"string|max:50",
            "lastName"=>"string|max:50",
            "password"=>"string|min:8|max:50",
            "email"=>"email|string|max:255",
            "mobile"=>"min:9|max:14|string",
            "roleId"=> "integer|exists:roles,id",
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException( response()->json(["success"=>false,"errors"=>$validator->errors()],422));
    }
}
