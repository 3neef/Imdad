<?php

namespace App\Http\Requests\UMRequests\User;

use App\Models\User;
use App\Models\UM\Role;
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
        $rules = [ 'userId' => 'required|integer|exists:users,id', 'role'=>'required|string|exists:roles,name' ,'companyId'=> 'required|integer|exists:company_info,id'];
        if($this->path() == 'api/users/unAssginRole' || $this->path() == 'api/users/oldRole'){
            $rules = [ 'userId' => 'required|integer|exists:users,id','companyId'=> 'required|integer|exists:company_info,id'];
        }else{
            if ( gettype( request()->role ) == 'integer' ) {
                $rules[ 'role' ] = 'required|integer|exists:roles,id';
            } else {
                $rules[ 'role' ] = 'required|string|exists:roles,name';
            }
        }

        return $rules;
    }

    public function withValidator($validator)
     {
        if(!$validator->fails()){
            $validator->after(function ($validator){
                if($this->path() != 'api/users/unAssginRole' && $this->path() != 'api/users/oldRole'){
                $user = User::find($this->get('userId'));
                $colmun = gettype($this ->json()->get( 'role' )) == 'integer' ? 'id' : 'name';
                $role = Role::where( $colmun, $this ->json()->get( 'role' ) )->first();
                $exists=$user->exists($this->get('userId'),$this->get('companyId'));
                //dd($exists);
                if(!empty($exists)){
                    $validator->errors()->add('user has role', 'this user has role with this company');
                }
            }
            });
        }
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException( response()->json(["success"=>false,"errors"=>$validator->errors()],422));
    }
}
