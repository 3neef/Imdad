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

    /**
        * @OA\Post(
        * path="/api/v1_0/categories/aprovedsubcatogre/{id}",
        * operationId="aprovedsubcatogre",
        * tags={"aprovedsubcatogre"},
        * summary="aproved sub catogry",
        * description="aproved sub catogry Here",
        *     @OA\RequestBody(
        *         @OA\JsonContent(),
        *         @OA\MediaType(
        *            mediaType="multipart/form-data",
        *            @OA\Schema(
        *               type="object",
        *               required={"id"},
        *               @OA\Property(property="id", type="integer"),
        *            ),
        *        ),
        *    ),
        *      @OA\Response(
        *          response=200,
        *          description="aproved Successfully"
        *       ),
        *      @OA\Response(response=404, description="Resource Not Found"),
        *      @OA\Response(response=400, description="Resource Not Found"),
        * )
        */
    public function aprovedsubcatogre( CreateCategoryRequest $request, $catogre_id )
 {
        return $this->categoryService->approveCategory( $catogre_id );
    }

/**
        * @OA\get(
        * path="/api/v1_0/categories/getByCompanyId/{companyId}",
        * operationId="getByCompanyId",
        * tags={"getByCompanyId"},
        * summary="get with company id",
        * description="get with company id Here",
        *     @OA\RequestBody(
        *         @OA\JsonContent(),
        *         @OA\MediaType(
        *            mediaType="multipart/form-data",
        *            @OA\Schema(
        *               type="object",
        *                required={"companyId"},
        *               @OA\Property(property="id", type="integer"),
        *            ),
        *        ),
        *    ),
        *      @OA\Response(
        *          response=200,
        *          description="data as json "
        *       ),
        *      @OA\Response(response=404, description="Resource Not Found"),
        * )
        */
    public function getByCompany( CreateCategoryRequest $request, $companyId )
 {
        return $this->categoryService->showCategoriesByCompanyId( $companyId );
    }
}
