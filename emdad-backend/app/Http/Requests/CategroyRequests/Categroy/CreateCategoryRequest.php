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
        $this->merge(['id' => $this->route('id')]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $id = empty($this->id)?1:$this->id;
        $rules = [
            'name' => 'required|unique:categories,name,' . $this->name . ',id,parent_id,' . $this->parentId,
            'isleaf' => 'required|boolean'
        ];
        if ($this->path() == 'api/categroyes/SavesubCatogre') {
            $rules = [
                'name' => 'required|unique:categories,name,' . $this->name . ',id,parent_id,' . $this->parentId,
                'parentId' => 'required|unique:categories,parent_id,' . $this->parentId . ',id,name,' . $this->name.'|exists:categories,id,isleaf,0',
                'isleaf' => 'required|boolean'
            ];
        }

        if ($this->path() == 'api/categroyes/aprovedcatogre/'.$id.'') {
            $rules = [
                'id' => 'required|integer|exists:categories,id'
            ];
        }
        if ($this->path() == 'api/categroyes/aprovedsubcatogre/'.$id.'') {
            $rules = [
                'id' => 'required|integer|exists:categories,id'
            ];
        }
        return $rules;
    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(["errors" => $validator->errors()], 404));
    }
}
