<?php

namespace App\Http\Requests\AccountRequests\Location;

use App\Rules\IsCompositeUnique;
use App\Rules\UniqeValues;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Unique;

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
            "userList" => ['array', new UniqeValues],
            "userList.*" => ['exists:users,id'],
            'warehouseName' => ['required','string','max:100', new IsCompositeUnique('warehouses',['profile_id'=>auth()->user()->profile_id,'address_name'=>$this->warehouseName])],
            'warehouseType' => ['required', 'string'],
            'latitude' => ['required', 'string'],
            'longitude' => ['required', 'string'],
            'gateType' => [ 'string'],
            'receiverName' => Rule::requiredIf(function () {
                return auth()->user()->currentProfile()->type== 'supplier';
                }),
            'receiverPhone' => Rule::requiredIf(function () {
                return auth()->user()->currentProfile()->type== 'supplier';
                }),
            'managerId' => ['integer', 'exists:users,id']
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException( response()->json(["success" => false, "errors" => $validator->errors(),"statusCode"=>"422"], 200));
    }
}
