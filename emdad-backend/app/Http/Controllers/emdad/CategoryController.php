<?php

namespace App\Http\Controllers\emdad;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategroyRequests\Categroy\changeCategoryStatusRequest;
use App\Http\Services\CategoryServices\CategoryService;
use App\Http\Requests\CategroyRequests\Categroy\CreateCategoryRequest;
use App\Http\Requests\CategroyRequests\Categroy\EmdadApproveCategoryRequest;
use App\Http\Requests\CategroyRequests\Categroy\FilterCategoryRequest;
use App\Http\Requests\CategroyRequests\Categroy\ProfileCategoryRequest;
use App\Http\Requests\CategroyRequests\Categroy\RetryApprovalRequest;
use App\Http\Requests\CategroyRequests\Categroy\UpdateCategoryRequest;
use App\Models\Emdad\Categories;

class CategoryController extends Controller
{
    protected CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {

        $this->categoryService = $categoryService;
    }
    /**
     * @OA\get(
     * path="/api/v1_0/categories",
     * operationId="addCategory",
     * tags={"Category"},
     * summary="add Category",
     * description="add category or a subcategory using parent id if it exists  by the company owner",
     *     @OA\Parameter(
     *         name="x-authorization",
     *         in="header",
     *         description="Set x-authorization",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *              @OA\Parameter(
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
     *               required={"nameEn","nameAr","note"},
     *               @OA\Property(property="nameEn", type="string"),
     *               @OA\Property(property="nameAr", type="string"),
     *               @OA\Property(property="parentId", type="integer"),
     *               @OA\Property(property="isleaf", type="boolean"),
     *               @OA\Property(property="note", type="string"),
     *               @OA\Property(property="type", type="string"),
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
        $this->authorize('create', Categories::class);

        return $this->categoryService->store($request);
    }

    /**
     * @OA\get(
     *    path="/api/v1_0/categories/{id}",
     *    operationId="showallcatogre",
     *    tags={"Category"},
     *    summary="show all catogries on the user profile",
     *    description="show all  Category Here",
     *     @OA\Parameter(
     *         name="x-authorization",
     *         in="header",
     *         description="Set x-authorization",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="token",
     *         in="header",
     *         description="Set user authentication token",
     *         @OA\Schema(
     *             type="beraer"
     *         )
     *     ),
     *      *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"perPage","onlyRequested"},
     *               @OA\Property(property="perPage", type="string"),
     *               @OA\Property(property="onlyRequested", type="boolean"),
     *            ),
     *        ),
     *    ),
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
        return $this->categoryService->index($request);
    }
    /**
     * @OA\delete(
     * path="/api/v1_0/categories/{id}",
     * operationId="deleteCategory",
     * tags={"Category"},
     * summary="Delete Category",
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
     * operationId="updateCategory",
     * tags={"Category"},
     * summary="update Category",
     * description="update Category using id",
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
     *               @OA\Property(property="parentId", type="integer"),
     *               @OA\Property(property="isleaf", type="boolean"),
     *               @OA\Property(property="status", type="string"),
     *               @OA\Property(property="reason", type="string"),
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
     * tags={"Category"},
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
     * path="/api/v1_0/categories/{Id}",
     * operationId="getBycategoryId",
     * tags={"Category"},
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


    /**
     * @OA\put(
     * path="/api/v1_0/categories/company-categories",
     * operationId="setFivoritecompanyCategory",
     * tags={"Category"},
     * summary="Retry Category",
     * description="set company Category",
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
     *               required={"categoryList"},
     *               @OA\Property(property="categoryList", type="string"),
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="Category request sent successfully",
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


    public function setFavoriteCategories(ProfileCategoryRequest $request)
    {
        return $this->categoryService->setCategories($request);
    }

    /**
     * @OA\put(
     * path="/api/v1_0/categories/RetryApproval/{id}",
     * operationId="RetryApproval",
     * tags={"Category"},
     * summary="Retry Category",
     * description="Request Category Approval",
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
     *               required={"categoryId" ,"reason"},
     *               @OA\Property(property="reason", type="string"),
     *               @OA\Property(property="categoryId", type="string"),
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="Category Approval request sent successfully",
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

    public function RetryRejectedCategories(RetryApprovalRequest $request)
    {
        return $this->categoryService->RetryApproval($request);
    }

    /**
     * @OA\put(
     * path="/api/v1_0/categories/changeCategoryStatus/{id}",
     * operationId="changeCategoryStatus",
     * tags={"Category"},
     * summary="change  Category status",
     * description="Request change  Category status",
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
     *               required={"category_id"},
     *               @OA\Property(property="category_id", type="integer"),

     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="changed successfully",
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
    public function ChangeCategoryStatus(changeCategoryStatusRequest $request)
    {
        return $this->categoryService->changeCategoryStatus($request);
    }
    /**
     * @OA\post(
     * path="/api/v1_0/categories/approveCategory",
     * operationId="approveCategory",
     * tags={"Category"},
     * summary="change  status approve Category",
     * description="Request status approve Category",
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
     *               required={"categoryId"},
     *               @OA\Property(property="categoryId", type="integer"),
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="aproved successfully",
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

    public function approveCategory(EmdadApproveCategoryRequest $request)
    {
        return $this->categoryService->approveCategory($request);
    }
    /**
     * @OA\post(
     * path="/api/v1_0/categories/rejectCategory",
     * operationId="rejectCategory",
     * tags={"Category"},
     * summary="change  status rejectCategory Category",
     * description="Request status rejectCategory Category",
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
     *               required={"categoryId"},
     *               @OA\Property(property="categoryId", type="integer"),

     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="rejected successfully",
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
    public function rejectCategory(EmdadApproveCategoryRequest $request)
    {
        return $this->categoryService->rejectCategory($request);
    }
    /**
     * @OA\get(
     * path="/api/v1_0/categories/serviceOrproduct",
     * operationId="filterCategory",
     * tags={"Category"},
     * summary="filter categories",
     * description="Check if the category type is prouduct service",
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
     *               required={"type"},
     *               @OA\Property(property="type", type="string"),
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="checked sucessfully successfully",
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
    public function filterCategory(FilterCategoryRequest $request)
    {
        return $this->categoryService->filterCategory($request);
    }

    /**
     * @OA\Get(
     * path="/api/v1_0/categories/getCategoryProfile",
     * operationId="getCategoryProfile",
     * tags={"Category"},
     * summary="filter categories",
     * description="Check if the category type is prouduct service",
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
     *          description="checked sucessfully successfully",
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
    public function getCategoryProfile(Request $request)
    {
        return $this->categoryService->getCategoryProfile($request);
    }

  
}
