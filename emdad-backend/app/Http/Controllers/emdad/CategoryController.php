<?php

namespace App\Http\Controllers\emdad;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\CategoryServices\CategoryService;
use App\Http\Requests\CategroyRequests\Categroy\CreateCategoryRequest;

class CategoryController extends Controller
{
    protected $catogreServec;
    public function __construct(CategoryService $catogreServec)
    {
        $this->catogreServec = $catogreServec;
    }

    public function addCatogre(CreateCategoryRequest $request)
    {
        return $this->catogreServec->addcatogre($request);
    }


    public function aprovedcatogre(CreateCategoryRequest $request,$catogre_id)
    {
        return $this->catogreServec->aprovedcatogre($catogre_id);
    }


    
    public function showallaprovedcatogre(Request $request)
    {
        return $this->catogreServec->showallaprovedcatogre();
    }
    public function showallcatogre(Request $request)
    {
        return $this->catogreServec->showallcatogre();
    }
    public function addsubCatogre(CreateCategoryRequest $request)
    {
        return $this->catogreServec->addsubCatogre($request);
    }
    public function showwithcatogreid(Request $request)
    {
        return $this->catogreServec->showwithcatogreid($request);
    }
    public function aprovedsubcatogre(CreateCategoryRequest $request,$catogre_id)
    {
        return $this->catogreServec->aprovedsubcatogre($catogre_id);
    }

    public function getByCompany(CreateCategoryRequest $request,$companyId)
    {
        return $this->catogreServec->showByCompanyId($companyId);
    }
}
