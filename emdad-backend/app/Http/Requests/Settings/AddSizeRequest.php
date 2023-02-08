<?php

namespace App\Http\Requests\Settings;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
class AddSizeRequest extends FormRequest
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
                'nameEn' => 'required|string',
                'nameAr' => 'required|string',
            ];
        return $rules;
    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(["success"=>false,"errors" => $validator->errors()], 404));
    }
}
