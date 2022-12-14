<?php

namespace App\Http\Requests\AccountRequests\Subscription;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class UpdateSubscriptionRequest extends FormRequest
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
            'id' => ['exists:subscription_packages,id'],
            'type' => ['string', Rule::in(['Buyer', 'Supplier'])], // 1 => Buyer, 2 => Supplier
            'updateOld' => ['required', 'boolean'],
            'subscriptionDetails' => ['required'],
            'subscriptionDetails.superAdmin' => ['required', 'integer'],
            'subscriptionDetails.users' => ['integer'],
            'subscriptionDetails.paymentMethods' => ['string'],
            'subscriptionDetails.delivery' => ['string'],
            'subscriptionDetails.warehouses' => ['integer'],
            'subscriptionDetails.addSuppliers' => ['integer'],
            'subscriptionDetails.itemInEachRequisition' => ['integer'],
            'subscriptionDetails.liveTracking' => ['boolean'],
            'subscriptionDetails.price' => ['string'],
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(response()->json(["success" => false, "errors" => $validator->errors()], 422));
    }
}
