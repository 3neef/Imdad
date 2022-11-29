<?php

namespace App\Http\Requests\CouponRequests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class CreateCouponRequest extends FormRequest
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
        // $id = empty($this->id)?1:$this->id;
        // $couponId = empty($this->couponId)?1:$this->couponId;
        // if($this->path() == 'api/v1_0/coupon/coupon/used'.$couponId.''){
        //     $this->merge(['couponId' => $this->route('used')]);
        // }else{
        //     $this->merge(['id' => $this->route('id')]);
        // }

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        // $couponId = empty($this->couponId)?1:$this->couponId;
        // $id = empty($this->id)?1:$this->id;

        if ($this->path() == 'api/v1_0/coupon/create') {
            $rules = [
                'allowed' => 'required|integer',
                'stratDate' => 'required|',
                'endDate' => 'required|after_or_equal:'.$this->stratDate.'',
                'value'=>'required|integer',
                'isPercentage'=>'required|boolean'
            ];



        }

        return $rules;
    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(["success"=>false,"errors" => $validator->errors()], 404));
    }}
