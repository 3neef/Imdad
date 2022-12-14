<?php

namespace App\Http\Requests\CategroyRequests\Categroy;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateCategoryRequest extends FormRequest
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
                'nameEn' => ['string', 'max:255'],
                'nameAr' => ['string', 'max:255'],
                'parentId' => ['exists:categories,id'],
                'isleaf' => ['boolean']
            ];
        }

        protected function failedValidation(Validator $validator): void
        {
            throw new HttpResponseException( response()->json(["success"=>false,"errors"=>$validator->errors()],422));
        }
}
