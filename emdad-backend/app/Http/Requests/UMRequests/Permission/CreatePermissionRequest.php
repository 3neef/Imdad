<?php

namespace App\Http\Requests\UMRequests\Permission;

use App\Rules\UniqeValues;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreatePermissionRequest extends FormRequest
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
            'role'=>'required|string|exists:roles,name',
            'privileges'=>['required','array',new UniqeValues],
            'privileges.*'=>['required','integer','exists:permissions,id'] 
        ];
        
        if (gettype(request()->role) == 'integer') {
            $rules['role'] = 'required|integer|exists:roles,id';
        } else {
            $rules['role'] = 'required|string|exists:roles,name';
        }
        return $rules;
    }


    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException( response()->json(["success"=>false,"errors"=>$validator->errors()],422));
    }


}
