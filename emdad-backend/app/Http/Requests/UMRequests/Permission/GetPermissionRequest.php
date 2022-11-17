<?php

namespace App\Http\Requests\UMRequests\Permission;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class GetPermissionRequest extends FormRequest
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
        return [
            'id' => ['required','integer','exists:roles,id']
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'id is required!',
            'id.exists' => 'id is inValid!',
            'id.integer' => 'id is must be integer',
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException( response()->json(["success"=>false,"errors"=>$validator->errors()],422));
    }
}
