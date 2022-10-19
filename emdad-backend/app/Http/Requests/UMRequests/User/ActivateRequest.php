<?php

namespace App\Http\Requests\UMRequests\User;

use Illuminate\Foundation\Http\FormRequest;

class ActivateRequest extends FormRequest
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
            "id"=>"required|integer|max:50|unique:users",
            "otp"=>"required|string|min:5|max:50",
        ];
    }
}
