<?php

namespace App\Http\Requests\CategroyRequests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateProuductRequest extends FormRequest
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
            'categoryId' => 'required|integer|exists:categories,id,isleaf,1',
            'name'=>'required|string|unique:products,name',
            'price'=>'required|between:0,99.99',
            'attachementFile'=>'required|image',
            'measruingUnit'=>'required',
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(response()->json(["success"=>false,"errors"=>$validator->errors()],422));
    }
}
