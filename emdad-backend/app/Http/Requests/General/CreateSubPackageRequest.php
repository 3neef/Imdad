<?php

namespace App\Http\Requests\General;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class CreateSubPackageRequest extends FormRequest
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
            'packageName'=>['required','unique:subscription_packages,subscription_name'],
            'type'=>['required','string',Rule::in(['Buyer','Supplier'])], // 1 => Buyer, 2 => Supplier
            'subscriptionDetails'=>['required'],
            'subscriptionDetails.superAdmin'=>['required','integer'],
            'subscriptionDetails.users'=>['integer'],
            'subscriptionDetails.paymentMethods'=>['string'],
            'subscriptionDetails.delivery'=>['string'],
            'subscriptionDetails.warehouses'=>['integer'],
            'subscriptionDetails.addSuppliers'=>['integer'],
            'subscriptionDetails.itemInEachRequisition'=>['integer'],
            'subscriptionDetails.liveTracking'=>['boolean'],
            'subscriptionDetails.FreePrice'=>['float'],
            'subscriptionDetails.BasePrice'=>['float'],
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException( response()->json(["success"=>false,"errors"=>$validator->errors()],422));
    }
}
