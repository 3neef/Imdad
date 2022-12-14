<?php

namespace App\Http\Requests\AccountRequests\Location;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateWarehouesesRequest extends FormRequest
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
            'warehouseName' => ['required','string','max:100'],
            'warehouseType' => ['required','string'],
            'location' => ['required','string'],
            'gateType' => ['required','string'],
            'receiverName' => ['required','string','max:25'],
            'receiverPhone' => ['required','string','max:15','min:15','regex:/^(00249)/']
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException( response()->json(["success"=>false,"errors"=>$validator->errors()],422));
    }
}