<?php

namespace App\Http\Requests\CategroyRequests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateProuductRequest extends FormRequest
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
            "categories_id" => 'integer|exists:categories,id,isleaf,1',
            'name' => 'string|unique:prodcuts,name',
            'price' => 'integer',
            'measruing_unit' => 'string|max:255',
            'image' => 'image',
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(response()->json(["success" => false, "errors" => $validator->errors()], 422));
    }
}
