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
            'id' => "required|integer|exists:users,id",
            "name"=>"string|max:50",
            "password"=>"string|min:8|max:50",
            "email"=>"email|string|max:255",
            "mobile"=>"min:9|max:14|string",
            "roleId"=> "integer|exists:roles,id",
            "companyId"=> "required|integer|exists:company_info,id"
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException( response()->json(["errors"=>$validator->errors()],422));
    }
}
