<?php

namespace App\Http\Requests\CategroyRequests\Categroy;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateCategoryRequest extends FormRequest
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
        $id = empty($this->id)?1:$this->id;
        $companyId = empty($this->companyId)?1:$this->companyId;
        if($this->path() == 'api/v1_0/categories/get-by-company-id/'.$companyId.''){
            $this->merge(['companyId' => $this->route('companyId')]);
        }else{
            $this->merge(['id' => $this->route('id')]);
        }

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */

        // $companyId = empty($this->companyId)?1:$this->companyId;
        // $id = empty($this->id)?1:$this->id;
        // $rules = [
        //     'name_ar' => 'required|unique:categories,name,' . $this->name . ',id,parent_id,' . $this->parentId,
        //     'name_en'=>'required|unique:categories,name',
        //     'isleaf' => 'required|boolean',
        // ];
        // if ($this->path() == 'api/v1_0/categories/save-sub-catogry') {
        //     $rules = [
        //         'name' => 'required|unique:categories,name,' . $this->name . ',id,parent_id,' . $this->parentId,
        //         'parent_id' => 'required|unique:categories,parent_id,' . $this->parentId . ',id,name,' . $this->name.'|exists:categories,id,isleaf,0',
        //         'isleaf' => 'required|boolean'
        //     ];
        // }

        // if ($this->path() == 'api/v1_0/categories/aproved-catogry/'.$id.'') {
        //     $rules = [
        //         'id' => 'required|integer|exists:categories,id'
        //     ];
        // }
        // if ($this->path() == 'api/v1_0/categories/aproved-sub-catogry/'.$id.'') {
        //     $rules = [
        //         'id' => 'required|integer|exists:categories,id'
        //     ];
        // }
        // if($this->path() == 'api/v1_0/categories/get-by-company-id/'.$companyId.''){
        //     $rules = [
        //         'companyId' => 'required|integer|exists:company_info,id'
        //     ];



        public function rules()
        {
            return [
                'nameAr' => ['required', 'string', 'max:255'],
                'nameEn' => ['required', 'string', 'max:255'],
                'age' => ['required', 'numeric'],
                'phone' => ['unique:drivers,phone', 'required', 'string', 'max:14', 'min:14', 'regex:/^(00249)/',],
                'nationality' => ['required', 'string', 'max:255'],
            ];
        }

        protected function failedValidation(Validator $validator): void
        {
            throw new HttpResponseException( response()->json(["success"=>false,"errors"=>$validator->errors()],422));
        }
}
