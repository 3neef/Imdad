<?php

namespace App\Http\Controllers\emdad;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategroyRequests\Product\CreateProuductRequest;
use App\Http\Requests\CategroyRequests\Product\GetProuductByIdRequest;
use App\Http\Requests\CategroyRequests\Product\RestoreProuductRequest;
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
        * path="/api/v1_0/products/create",
        * operationId="createProduct",
        * tags={"Product"},
        * summary="create Product",
        * description="create Product Here",
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
    public function createProduct(CreateProuductRequest $request)
    {
        return $this->productService->createProdcut($request);
    }

    /**
        * @OA\put(
        * path="/api/v1_0/products/update",
        * operationId="updateProduct",
        * tags={"Product"},
        * summary="update Product",
        * description="update Product Here",
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

    public function updateProduct(UpdateProuductRequest $request)
    {
        return $this->productService->update($request);
    }



/**
        * @OA\get(
        * path="/api/v1_0/products/getAll",
        * operationId="getAllProducts",
        * tags={"Product"},
        * summary="get All Products",
        * description="get All Products Here",
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


    public function getAllProducts()
    {
        return $this->productService->getAll();
    }


/**
        * @OA\get(
        * path="/api/v1_0/products/get-By-Id/{id}",
        * operationId="getByProductId",
        * tags={"Product"},
        * summary="get By ProductId",
        * description="get By ProductId Here",
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
    public function getByProductId(GetProuductByIdRequest $request,$id)
    {
        return $this->productService->getById($id);
    }

/**
        * @OA\delete(
        * path="/api/v1_0/products/delete/{id}",
        * operationId="deleteProduct",
        * tags={"Product"},
        * summary="delete Product",
        * description="delete Product Here",
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

    public function deleteProduct(GetProuductByIdRequest $request,$id)
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

    public function restoreByProductId(RestoreProuductRequest $request,$id)
    {
        return $this->productService->restore($id);
    }
}
