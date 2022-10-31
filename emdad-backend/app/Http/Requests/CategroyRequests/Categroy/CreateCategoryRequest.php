<?php

namespace App\Http\Requests\CategroyRequests\Categroy;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateCategoryRequest extends FormRequest
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
        if($this->path() == 'api/v1_0/categroyes/getByCompanyId/'.$companyId.''){
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
    public function rules()
    {
        $companyId = empty($this->companyId)?1:$this->companyId;
        $id = empty($this->id)?1:$this->id;
        $rules = [
            'name' => 'required|unique:categories,name,' . $this->name . ',id,parent_id,' . $this->parentId,
            'isleaf' => 'required|boolean',
            'companyId' => 'required|integer|exists:company_info,id',
        ];
        if ($this->path() == 'api/v1_0/categroyes/SavesubCatogre') {
            $rules = [
                'name' => 'required|unique:categories,name,' . $this->name . ',id,parent_id,' . $this->parentId,
                'parent_id' => 'required|unique:categories,parent_id,' . $this->parentId . ',id,name,' . $this->name.'|exists:categories,id,isleaf,0',
                'isleaf' => 'required|boolean'
            ];
        }

        if ($this->path() == 'api/v1_0/categroyes/aprovedcatogre/'.$id.'') {
            $rules = [
                'id' => 'required|integer|exists:categories,id'
            ];
        }
        if ($this->path() == 'api/v1_0/categroyes/aprovedsubcatogre/'.$id.'') {
            $rules = [
                'id' => 'required|integer|exists:categories,id'
            ];
        }
        if($this->path() == 'api/v1_0/categroyes/getByCompanyId/'.$companyId.''){
            $rules = [
                'companyId' => 'required|integer|exists:company_info,id'
            ];
        }
        return $rules;
    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(["errors" => $validator->errors()], 404));
    }
}
