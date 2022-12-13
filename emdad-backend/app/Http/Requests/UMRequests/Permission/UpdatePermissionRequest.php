<?php

namespace App\Http\Requests\UMRequests\Permission;

use App\Rules\UniqeValues;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdatePermissionRequest extends FormRequest
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
            'role_id' => ['integer','exists:role_permissions,role_id'],
            'privileges'=>['array',new UniqeValues],
            'privileges.*'=>['integer','exists:permissions,id']
        ];
    }



    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException( response()->json(["success"=>false,"errors"=>$validator->errors()],422));
    }
}
