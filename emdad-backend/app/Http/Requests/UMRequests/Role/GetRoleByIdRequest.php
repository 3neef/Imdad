<?php

namespace App\Http\Requests\UMRequests\Role;

use App\Rules\CheckUserHasRole;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class GetRoleByIdRequest extends FormRequest
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
        $uri = $this->path();
        $id = $this->id == null ? "1" : $this->id;
        if($uri == 'api/roles/getByRoleId/'.$id.'' || $uri == 'api/roles/delete/'.$id.''){
            $this->merge(['id' => $this->route('id')]);
        }else{
            $this->merge(['type' => $this->route('type')]); 
        }
        
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $type = $this->type == null ? "1" : $this->type;
        $rules =['id' => ['required','integer','exists:roles,id']];
        if($this->isMethod('delete')){
            $rules =['id' => ['required','integer','exists:roles,id',new CheckUserHasRole]];
        }elseif($this->path() == 'api/roles/getByType/'.$type.''){
           // dd('type');
            $rules =['type' => ['required','integer','between:0,2']];
        }
        //dd($this->path());
        return $rules;
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException( response()->json(["success"=>false,"errors"=>$validator->errors()],422));
    }
}
