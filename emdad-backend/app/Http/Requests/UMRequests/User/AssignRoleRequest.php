<?php

namespace App\Http\Requests\UMRequests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class AssignRoleRequest extends FormRequest {
    /**
    * Determine if the user is authorized to make this request.
    *
    * @return bool
    */

    public function authorize() {
        return true;
    }

    /**
    * Get the validation rules that apply to the request.
    *
    * @return array<string, mixed>
    */

    public function rules() {
        $rules = [ 'userId' => 'required|integer|exists:users,id', 'role'=>'required|string|exists:roles,name' ];
        if ( gettype( request()->role ) == 'integer' ) {
            $rules[ 'role' ] = 'required|integer|exists:roles,id';
        } else {
            $rules[ 'role' ] = 'required|string|exists:roles,name';
        }
        return $rules;
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException( response()->json(["errors"=>$validator->errors()],422));
    }
}
