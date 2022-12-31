<?php

namespace App\Http\Controllers\emdad;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategroyRequests\Category\ProfileCategoryRequest;
use App\Http\Requests\CategroyRequests\CategroyRetryApprovalRequest;
use App\Http\Services\CategoryServices\CategoryService;
use App\Http\Requests\CategroyRequests\Categroy\CreateCategoryRequest;
use App\Http\Requests\CategroyRequests\Categroy\RetryApprovalRequest;
use App\Http\Requests\CategroyRequests\Categroy\UpdateCategoryRequest;
use App\Http\Requests\CategroyRequests\Product\changeCategoryStatusRequest;

class CategoryController extends Controller
{
    protected CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {

        $this->categoryService = $categoryService;
    }
    /**
     * @OA\Post(
     * path="/api/v1_0/categories",
     * operationId="addcatogry",
     * tags={"Catogry"},
     * summary="add catogry",
     * description="add category or a subcategory using parent id if it exists  by the company owner",
     *     @OA\Parameter(
     *         name="x-authorization",
     *         in="header",
     *         description="Set x-authorization",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *         *     @OA\Parameter(
     *         name="token",
     *         in="header",
     *         description="Set user authentication token",
     *         @OA\Schema(
     *             type="beraer"
     *           )
     *     ),
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"nameEn","nameAr","isleaf","companyId"},
     *               @OA\Property(property="nameEn", type="string"),
     *               @OA\Property(property="nameAr", type="string"),
     *               @OA\Property(property="isleaf", type="boolean"),
     *               @OA\Property(property="companyId", type="integer")
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=201,
     *          description="created Successfully",
     *       ),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function store(CreateCategoryRequest $request)
    {
        return $this->categoryService->store($request);
    }

    /**
     * @OA\get(
     *    path="/api/v1_0/categories",
     *    operationId="showallcatogre",
     *    tags={"Catogry"},
     *    summary="show all catogries on the user profile",
     *    description="show all  catogry Here",
     *     @OA\Parameter(
     *         name="x-authorization",
     *         in="header",
     *         description="Set x-authorization",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *         *     @OA\Parameter(
     *         name="token",
     *         in="header",
     *         description="Set user authentication token",
     *         @OA\Schema(
     *             type="beraer"
     *         )
     *     ),
     *    @OA\Response(
     *         response=200,
     *         description="",
     *         @OA\JsonContent(
     *         @OA\Property(property="Maincatogre", type="integer", example="{'id': 1, 'name': 'tv','aproved': 0, 'parent_id': 1, 'isleaf': 1, 'company_id': 1}")
     *          ),
     *       )
     *      )
     *  )
     */
    public function index(Request $request)
    {
        return $this->categoryService->index( $request);
    }
/**
     * @OA\delete(
     * path="/api/v1_0/categories/{id}",
     * operationId="deleteCatogry",
     * tags={"Catogry"},
     * summary="Delete Catogry",
     * description="delete Category using Category id",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="x-authorization",
     *         in="header",
     *         description="Set x-authorization",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *         *     @OA\Parameter(
     *         name="token",
     *         in="header",
     *         description="Set user authentication token",
     *         @OA\Schema(
     *             type="beraer"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="application-json",
     *            @OA\Schema(
     *               type="object",
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=301,
     *          description="Category deleted successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */

    public function destroy($id)
    {
        return $this->categoryService->destroy($id);
    }
   /**
     * @OA\put(
     * path="/api/v1_0/categories/{id}",
     * operationId="updateCatogry",
     * tags={"Catogry"},
     * summary="update Catogry",
     * description="update Catogry using id",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="x-authorization",
     *         in="header",
     *         description="Set x-authorization",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *         *     @OA\Parameter(
     *         name="token",
     *         in="header",
     *         description="Set user authentication token",
     *         @OA\Schema(
     *             type="beraer"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               @OA\Property(property="nameEn", type="string"),
     *               @OA\Property(property="nameAr", type="string"),
     *               @OA\Property(property="isleaf", type="boolean"),
     *               @OA\Property(property="companyId", type="integer")
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="Category updated successfully",
     *          @OA\JsonContent(),
     *          @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               @OA\Property(property="message", type="string"),
     *               @OA\Property(property="data", type = "object")
     *            ),
     *          ),
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */

    public function update(UpdateCategoryRequest $request, $id)
    {
        return $this->categoryService->update($request, $id);
    }



    /**
     * @OA\get(
     * path="/api/v1_0/categories/restore/{id}",
     * operationId="restoreCategory",
     * tags={"Catogry"},
     * summary="restore category",
     * description="restore deleted category",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="x-authorization",
     *         in="header",
     *         description="Set x-authorization",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *         *     @OA\Parameter(
     *         name="token",
     *         in="header",
     *         description="Set user authentication token",
     *         @OA\Schema(
     *             type="beraer"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="",
     *         @OA\JsonContent(
     *         @OA\Property(property="Maincatogre", type="integer", example="{'id': 2, 'name': 'tv','aproved': 0, 'parent_id': 1, 'isleaf': 1, 'company_id': 1}")
     *          ),
     *       ),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */

    public function restore($id)
    {
        return $this->categoryService->restore($id);
    }
/**
        * @OA\get(
        * path="/api/v1_0/categories/{id}",
        * operationId="getBycategoryId",
        * tags={"Catogry"},
        * summary="get By categoryId",
        * description="show category with a specifc id",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="x-authorization",
     *         in="header",
     *         description="Set x-authorization",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *         *     @OA\Parameter(
     *         name="token",
     *         in="header",
     *         description="Set user authentication token",
     *         @OA\Schema(
     *             type="beraer"
     *         )
     *     ),
        *     @OA\RequestBody(
        *         @OA\JsonContent(),
        *         @OA\MediaType(
        *            mediaType="multipart/form-data",
        *            @OA\Schema(
        *               type="object",
        *            ),
        *        ),
        *    ),
        *      @OA\Response(
        *          response=200,
        *          description="",
        *         @OA\JsonContent(
        *         @OA\Property(property="categoryById", type="integer", example="{'id': 2, 'name': 'LG','salary': 10000, 'parent_id': 1,'company_id': 1}")
        *          ),

        *       ),
        *      @OA\Response(response=404, description="Resource Not Found"),
        * )
        */


    public function show($id)
    {
        return $this->categoryService->show($id);
    }




    public function setFavoriteCategories(ProfileCategoryRequest $request)
    {
        return $this->categoryService->setCategories($request);
    }

    public function RetryRejectedCategories(RetryApprovalRequest $request){
        return $this->categoryService->RetryApproval($request);
    }

    public function ChangeCategoryStatus(changeCategoryStatusRequest $request){
        return $this->categoryService->changeCategoryStatus($request);
    }
}
