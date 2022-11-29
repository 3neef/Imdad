<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
class RemoveUserRequets extends FormRequest
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
        $rules =['id' => ['required','integer','exists:users,id']];
    
        return $rules;
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException( response()->json(["success"=>false,"errors"=>$validator->errors()],422));
    }
}
