<?php

namespace App\Http\Requests\AccountRequests\Location;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateLocationRequest extends FormRequest
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
            'warehouse_name' => ['required','string','max:100'],
            'warehouse_type' => ['required','string'],
            'location' => ['required','string','regex:/\d+\/\d+/'],
            'gate_type' => ['required','string'],
            'receiver_name' => ['required','string','max:25'],
            'receiver_phone' => ['required','string','max:15','min:15','regex:/^(00966)/']
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException( response()->json(["errors"=>$validator->errors()],422));
    }
}