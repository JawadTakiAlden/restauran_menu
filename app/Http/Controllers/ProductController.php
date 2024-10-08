<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Services\Product\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(protected ProductService $productService)
    {
    }

    public function getAll(){
       return $this->productService->getAll();
   }

   public function getProductsByCategory($categoryID){
        return $this->productService->getProductByCatgeory($categoryID);
   }

   public function create(CreateProductRequest $request){
        return $this->productService->create($request);
   }

   public function delete(int $productId){
        return $this->productService->delete($productId);
   }

   public function update(int $productId , UpdateProductRequest $request){
        return $this->productService->update($productId , $request);
   }
}
