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
       /**
        * @OA\Post(
        * path="/api/v1_0/categroyes/SaveCatogry",
        * operationId="addcatogry",
        * tags={"addcatogry"},
        * summary="add catogry",
        * description="add catogry Here",
        *     @OA\RequestBody(
        *         @OA\JsonContent(),
        *         @OA\MediaType(
        *            mediaType="multipart/form-data",
        *            @OA\Schema(
        *               type="object",
        *               required={"name", "isleaf" ,"companyId"},
        *               @OA\Property(property="name", type="string"),
        *               @OA\Property(property="isleaf", type="boolean")
        *               @OA\Property(property="companyId", type="integer")
        *            ),
        *        ),
        *    ),
        *      @OA\Response(
        *          response=201,
        *          description="created Successfully",
        *          @OA\JsonContent()
        *       ),
        *      @OA\Response(response=404, description="Resource Not Found"),
        * )
        */
    public function addCatogry( CreateCategoryRequest $request )
 {
        return $this->categoryService->addCategory( $request );
    }
/**
        * @OA\Post(
        * path="/api/v1_0/categroyes/aprovedcatogre/{id}",
        * operationId="aprovedcatogre",
        * tags={"aprovedcatogry"},
        * summary="aproved catogry",
        * description="aproved catogry Here",
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
        *          description="aproved Successfully",
        *          @OA\JsonContent()
        *       ),
        *      @OA\Response(response=404, description="Resource Not Found"),
        * )
        */
    public function aprovedcatogre( CreateCategoryRequest $request, $catogre_id )
 {
        return $this->categoryService->approveCategory( $catogre_id );
}
/**
        * @OA\get(
        * path="/api/v1_0/categroyes/showallaprovedcatogre",
        * operationId="showallaprovedcatogre",
        * tags={"showallaprovedcatogre"},
        * summary="show all aproved catogry",
        * description="show all aproved catogry Here",
        *     @OA\RequestBody(
        *         @OA\JsonContent(),
        *         @OA\MediaType(
        *            mediaType="multipart/form-data",
        *            @OA\Schema(
        *               type="object"
        *            ),
        *        ),
        *    ),
        *      @OA\Response(
        *          response=200,
        *          description="data {data}",
        *          @OA\JsonContent()
        *       ),
        * )
        */


    public function showallaprovedcatogre( Request $request )
 {
        return $this->categoryService->showAllApprovedCategories();
    }

/**
        * @OA\get(
        * path="/api/v1_0/categroyes/showallaprovedcatogre",
        * operationId="showallaprovedcatogre",
        * tags={"showallaprovedcatogre"},
        * summary="show all aproved catogry",
        * description="show all aproved catogry Here",
        *     @OA\RequestBody(
        *         @OA\JsonContent(),
        *         @OA\MediaType(
        *            mediaType="multipart/form-data",
        *            @OA\Schema(
        *               type="object"
        *            ),
        *        ),
        *    ),
        *      @OA\Response(
        *          response=200,
        *          description="data of Maincatogre as json",
        *          @OA\JsonContent()
        *       ),
        * )
        */
    public function showallcatogre( Request $request )
 {
        return $this->categoryService->showAllCategories();
    }

       /**
        * @OA\Post(
        * path="/api/v1_0/categroyes/SavesubCatogre",
        * operationId="SavesubCatogre",
        * tags={"SavesubCatogre"},
        * summary="save sub catogry",
        * description="save sub catogry Here",
        *     @OA\RequestBody(
        *         @OA\JsonContent(),
        *         @OA\MediaType(
        *            mediaType="multipart/form-data",
        *            @OA\Schema(
        *               type="object",
        *               required={"name", "parent_id" ,"isleaf"},
        *               @OA\Property(property="name", type="string"),
        *               @OA\Property(property="parent_id", type="integer")
        *               @OA\Property(property="isleaf", type="boolean")
        *            ),
        *        ),
        *    ),
        *      @OA\Response(
        *          response=201,
        *          description="created Successfully",
        *          @OA\JsonContent()
        *       ),
        *      @OA\Response(response=404, description="Resource Not Found"),
        * )
        */
    public function addsubCatogre( CreateCategoryRequest $request )
 {
        return $this->categoryService->addSubCategory( $request );
    }
/**
        * @OA\get(
        * path="/api/v1_0/categroyes/showwithcatogreid",
        * operationId="showwithcatogreid",
        * tags={"showwithcatogreid"},
        * summary="show with catogry id",
        * description="show with catogry id Here",
        *     @OA\RequestBody(
        *         @OA\JsonContent(),
        *         @OA\MediaType(
        *            mediaType="multipart/form-data",
        *            @OA\Schema(
        *               type="object"
        *            ),
        *        ),
        *    ),
        *      @OA\Response(
        *          response=200,
        *          description="data as json ",
        *          @OA\JsonContent()
        *       ),
        * )
        */

    public function showwithcatogreid( Request $request )
 {
        return $this->categoryService->showApprovedWithParentCategoryId( $request );
    }

    /**
        * @OA\Post(
        * path="/api/v1_0/categroyes/aprovedsubcatogre/{id}",
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
        *          description="aproved Successfully",
        *          @OA\JsonContent()
        *       ),
        *      @OA\Response(response=404, description="Resource Not Found"),
        * )
        */
    public function aprovedsubcatogre( CreateCategoryRequest $request, $catogre_id )
 {
        return $this->categoryService->approveCategory( $catogre_id );
    }

/**
        * @OA\get(
        * path="/api/v1_0/categroyes/getByCompanyId/{companyId}",
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
        *          description="data as json ",
        *          @OA\JsonContent()
        *       ),
        *      @OA\Response(response=404, description="Resource Not Found"),
        * )
        */
    public function getByCompany( CreateCategoryRequest $request, $companyId )
 {
        return $this->categoryService->showCategoriesByCompanyId( $companyId );
    }
}
