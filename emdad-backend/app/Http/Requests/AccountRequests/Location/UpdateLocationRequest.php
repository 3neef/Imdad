<?php

namespace App\Http\Requests\AccountRequests\Location;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateLocationRequest extends FormRequest
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
            'id' => ['required','integer','exists:company_locations,id'],
            'warehouseName' => ['string','max:100'],
            'warehouseType' => ['string'],
            'location' => ['string'],
            'gateType' => ['string'],
            'receiverName' => ['string','max:25'],
            'receiverPhone' => ['string','max:15','min:15','regex:/^(00966)/']
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException( response()->json(["success"=>false,"errors"=>$validator->errors()],422));
    }
}