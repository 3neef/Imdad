<?php

namespace App\Http\Controllers\emdad;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\CategoryServices\CategoryService;
use App\Http\Requests\CategroyRequests\Categroy\CreateCategoryRequest;

class CategoryController extends Controller
 {
    protected CategoryService $categoryService ;

    public function __construct( CategoryService $categoryService )
 {

        $this->categoryService = $categoryService;
    }

    public function addCatogry( CreateCategoryRequest $request )
 {
        return $this->categoryService->addCategory( $request );
    }

    public function aprovedcatogre( CreateCategoryRequest $request, $catogre_id )
 {
        return $this->categoryService->approveCategory( $catogre_id );
    }

    public function showallaprovedcatogre( Request $request )
 {
        return $this->categoryService->showAllApprovedCategories();
    }

    public function showallcatogre( Request $request )
 {
        return $this->categoryService->showAllCategories();
    }

    public function addsubCatogre( CreateCategoryRequest $request )
 {
        return $this->categoryService->addSubCategory( $request );
    }

    public function showwithcatogreid( Request $request )
 {
        return $this->categoryService->showApprovedWithParentCategoryId( $request );
    }

    public function aprovedsubcatogre( CreateCategoryRequest $request, $catogre_id )
 {
        return $this->categoryService->approveCategory( $catogre_id );
    }

    public function getByCompany( CreateCategoryRequest $request, $companyId )
 {
        return $this->categoryService->showCategoriesByCompanyId( $companyId );
    }
}
