<?php

namespace App\Http\Requests\UMRequests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class DepartmentRequest extends FormRequest
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
            'name'=>'required|string|max:255',
        ];
    }


    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException( response()->json(["errors"=>$validator->errors()],422));
    }
}