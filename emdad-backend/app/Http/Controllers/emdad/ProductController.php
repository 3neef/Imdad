<?php

namespace App\Http\Controllers\emdad;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategroyRequests\Product\CompanyProductRequest;
use App\Http\Requests\CategroyRequests\Product\CreateProuductRequest;
use App\Http\Requests\CategroyRequests\Product\StatusCompanyProductRequest;
use App\Http\Requests\CategroyRequests\Product\UpdateProuductRequest;
use App\Http\Services\CategoryServices\ProductService;

class ProductController extends Controller
{
    protected ProductService $productService;

    /**
     * Create a new controller instance.
     *
     * @param  App\Http\Services\CategoryServices\ProductService  $productService
     * @return void
     */
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }
/**
        * @OA\Post(
        * path="/api/v1_0/products",
        * operationId="createProduct",
        * tags={"Product"},
        * summary="create Product",
        * description="create Product Here",
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
        *               required={"categoryId","name","price"},
        *               @OA\Property(property="categoryId", type="integer"),
        *               @OA\Property(property="name", type="string"),
        *               @OA\Property(property="price", type="integer")
        *            ),
        *        ),
        *    ),
        *      @OA\Response(
        *        response=200,
        *          description="created Successfully"
        *       ),
        *      @OA\Response(response=404, description="Resource Not Found"),
         *      @OA\Response(response=500, description="system error")
        * )
        */
    public function store(CreateProuductRequest $request)
    {
        return $this->productService->store($request);
    }

    /**
        * @OA\put(
        * path="/api/v1_0/products",
        * operationId="updateProduct",
        * tags={"Product"},
        * summary="update Product",
        * description="update Product Here",
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
        *               required={"id","name","price"},
        *               @OA\Property(property="id", type="integer"),
        *               @OA\Property(property="name", type="string"),
        *               @OA\Property(property="price", type="integer")
        *            ),
        *        ),
        *    ),
        *      @OA\Response(
        *          response=200,
        *          description="updated Successfully"
        *       ),
        *      @OA\Response(response=500, description="error"),
        *      @OA\Response(response=404, description="Resource Not Found"),

        * )
        */

    public function update(UpdateProuductRequest $request,$id)
    {
        return $this->productService->update($request,$id);
    }



/**
        * @OA\get(
        * path="/api/v1_0/products",
        * operationId="getAllProducts",
        * tags={"Product"},
        * summary="get All Products",
        * description="get All Products Here",
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
        *          description="",
        *         @OA\JsonContent(
        *         @OA\Property(property="MainProduct", type="integer", example="{'id': 2, 'name': 'LG','salary': 10000, 'parent_id': 1,'company_id': 1}")
        *          ),
        *       ),
        *      @OA\Response(response=404, description="Resource Not Found"),
        * )
        */


    public function index(Request $request)
    {
        return $this->productService->index($request);
    }


/**
        * @OA\get(
        * path="/api/v1_0/products/get-By-Id/{id}",
        * operationId="getByProductId",
        * tags={"Product"},
        * summary="get By ProductId",
        * description="get By ProductId Here",
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
        *         @OA\Property(property="ProductById", type="integer", example="{'id': 2, 'name': 'LG','salary': 10000, 'parent_id': 1,'company_id': 1}")
        *          ),

        *       ),
        *      @OA\Response(response=404, description="Resource Not Found"),
        * )
        */
    public function show($id)
    {
        return $this->productService->show($id);
    }

/**
        * @OA\delete(
        * path="/api/v1_0/products/delete/{id}",
        * operationId="deleteProduct",
        * tags={"Product"},
        * summary="delete Product",
        * description="delete Product Here",
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
        *          response=301,
        *          description="deleted successfully"
        *       ),
        *      @OA\Response(response=404, description="Resource Not Found"),
        * )
        */

    public function destroy($id)
    {
        return $this->productService->delete($id);
    }

/**
        * @OA\put(
        * path="/api/v1_0/products/restore/{id}",
        * operationId="restoreByProductId",
        * tags={"Product"},
        * summary="restore By ProductId",
        * description="restore By ProductId Here",
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
        *          description="restored successfully"
        *       ),
        *      @OA\Response(response=500, description="Resource Not Found"),
        *      @OA\Response(response=404, description="system error"),
        * )
        */

    public function restore($id)
    {
        return $this->productService->restore($id);
    }






/**
        * @OA\post(
        * path="/api/v1_0/products/company-products",
        * operationId="companyproduct",
        * tags={"Product"},
        * summary="set company product",
        * description="company product Here",
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
        *               required={"productList"},
        *               @OA\Property(property="productList", type="integer")
        *            ),
        *        ),
        *    ),
        *      @OA\Response(
        *          response=200,
        *          description="restored successfully"
        *       ),
        *      @OA\Response(response=500, description="Resource Not Found"),
        *      @OA\Response(response=404, description="system error"),
        * )
        */
    public function setCompanyProduct(CompanyProductRequest $request)
    {
        return $this->productService->setcompanyproducts($request);
    }


    /**
        * @OA\post(
        * path="/api/v1_0/products/change-Product-Status",
        * operationId="changeProductStatus",
        * tags={"Product"},
        * summary="set change Product Status",
        * description="set change Product Status Here",
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
        *               required={"product_id"},
        *               @OA\Property(property="product_id", type="integer")
        *            ),
        *        ),
        *    ),
        *      @OA\Response(
        *          response=200,
        *          description="restored successfully"
        *       ),
        *      @OA\Response(response=500, description="Resource Not Found"),
        *      @OA\Response(response=404, description="system error"),
        * )
        */
    public function changeProductStatus(StatusCompanyProductRequest $request)
    {
        return $this->productService->changeProductStatus($request);
    }
    
}
