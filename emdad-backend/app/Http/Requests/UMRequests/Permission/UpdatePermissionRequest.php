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
            'id' => ['required','integer','exists:roles,id'],
            'privileges'=>['required','array',new UniqeValues],
            'privileges.*'=>['required','integer','exists:permissions,id']  
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'id is required!',
            'id.exists' => 'id is inValid!',
            'id.integer' => 'id is must be integer',
            'privileges.required' => 'privileges is required!',
            'privileges.array' => 'privileges is must be array!',
            'privileges.*.required' => ':attribute is required!',
            'privileges.*.integer' => ':attribute is must be integer',
            'privileges.*.exists' => ':attribute is inValid'
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException( response()->json(["errors"=>$validator->errors()],422));
    }
}
