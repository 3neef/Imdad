<?php

namespace App\Http\Controllers\emdad;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\CategoryServices\CategoryService;
use App\Http\Requests\CategroyRequests\Categroy\CreateCategoryRequest;
use App\Http\Requests\CategroyRequests\Categroy\UpdateCategoryRequest;

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
     * description="add catogry Here",
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
     *               required={"name","isleaf","companyId"},
     *               @OA\Property(property="name", type="string"),
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
     * @OA\Post(
     * path="/api/v1_0/categories/aproved-catogry/{id}",
     * operationId="aprovedcatogre",
     * tags={"Catogry"},
     * summary="aproved catogry",
     * description="aproved catogry Here",
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
     * )
     */
    public function aprovedCatogry($id)
    {
        return $this->categoryService->approveCategory($id);
    }


    /**
     * @OA\get(
     *    path="/api/v1_0/categories",
     *    operationId="showallcatogre",
     *    tags={"Catogry"},
     *    summary="show all  catogry",
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
    public function index()
    {
        return $this->categoryService->index();
    }

    /**
     * @OA\Post(
     * path="/api/v1_0/categories/save-sub-catogry",
     * operationId="SavesubCatogre",
     * tags={"Catogry"},
     * summary="save sub catogry",
     * description="save sub catogry Here",
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
     *               required={"name","parent_id","isleaf"},
     *               @OA\Property(property="name", type="string"),
     *               @OA\Property(property="parent_id", type="integer"),
     *               @OA\Property(property="isleaf", type="boolean")
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=201,
     *          description="created Successfully"
     *       ),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function destroy($id)
    {
        return $this->categoryService->destroy($id);
    }
    /**
     * @OA\get(
     * path="/api/v1_0/categories/show-with-catogry-id",
     * operationId="showwithcategoryid",
     * tags={"Catogry"},
     * summary="show with catogry id",
     * description="show with catogry id Here",
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
     *               required={""},
     *               @OA\Property(property="", type="")
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="data as json "
     *       ),
     * )
     */

    public function update(UpdateCategoryRequest $request, $id)
    {
        return $this->categoryService->update($request, $id);
    }



    /**
     * @OA\get(
     * path="/api/v1_0/categories/get-by-company-id/{companyId}",
     * operationId="getbycompanyid",
     * tags={"Catogry"},
     * summary="get with company id",
     * description="get with company id Here",
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
     *                required={"companyId"},
     *               @OA\Property(property="id", type="integer")
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
        * path="/api/v1_0/categories/get-By-Id/{id}",
        * operationId="getBycategoryId",
        * tags={"Product"},
        * summary="get By categoryId",
        * description="get By categoryId Here",
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
        *               required={"id"},
        *               @OA\Property(property="id", type="integer")
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
}
