<?php

namespace App\Http\Requests\CategroyRequests\Categroy;

use App\Rules\UniqeValues;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProfileCategoryRequest extends FormRequest
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
            "categoryList" => ['required_without:category_id', 'array', new UniqeValues],
            "categoryList.*" => ['exists:categories,id'],
            'category_id' => ['exists:categories,id'],
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(response()->json(["success" => false, "errors" => $validator->errors()], 422));
    }
}