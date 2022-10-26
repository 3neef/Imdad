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

    public function createProduct(CreateProuductRequest $request)
    {
        return $this->productService->createProdcut($request);
    }

    public function updateProduct(UpdateProuductRequest $request)
    {
        return $this->productService->update($request);
    }

    public function getAllProducts()
    {
        return $this->productService->getAll();
    }

    public function getByProductId(GetProuductByIdRequest $request,$id)
    {
        return $this->productService->getById($id);
    }

    public function deleteProduct(GetProuductByIdRequest $request,$id)
    {
        return $this->productService->delete($id);
    }
    
    public function restoreByProductId(RestoreProuductRequest $request,$id)
    {
        return $this->productService->restore($id);
    }
}
