<?php

namespace App\Http\Requests\UMRequests\User;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

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
// dd($this->id);
        return [
            "fullName" => "string|max:100",
            "password" => "string|min:8|max:50",
            "identityNumber"=>['string',Rule::unique('users',"identity_number")->ignore($this->id, 'id')],
            "email" => ["email", "string", "max:255"],
            "mobile" => ["min:9","max:14","string",Rule::unique('users')->ignore($this->id, 'id')],
            "roleId" => "integer|exists:roles,id",
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(response()->json(["success" => false, "errors" => $validator->errors()], 422));
    }
}
