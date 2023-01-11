<?php

namespace App\Http\Requests\AccountRequests\Truck;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateTruckRequest extends FormRequest
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
            'name' =>['required','string','max:150'],
            'type'=>['required','string'],
            'class'=>['required','string'],
            'color'=>['required','string'],
            'model'=>['required','string'],
            'size'=>['required','string'],
            'brand'=>['required','string'],
            'image'=>['required','image'],
        ];

    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(  response()->json(["success" => false, "errors" => $validator->errors(),"statusCode"=>"422"], 200));
    }
}
