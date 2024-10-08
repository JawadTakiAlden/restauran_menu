<?php

namespace App\Services\Product;

use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\HttpResponse\HTTPResponse;
use App\Repositories\Product\ProductRepoI;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class ProductService
{
    use HTTPResponse;
    public function __construct(protected ProductRepoI $productRepo)
    {
    }

    public function getAll(){
        try {
            $products  = $this->productRepo->getAll();
            return $this->success(ProductResource::collection($products));
        }catch (\Throwable $th){
            return $this->serverError();
        }
    }

    public function getProductByCatgeory(int $categoryId){
        try {
            $products  = $this->productRepo->getProductOfCategory($categoryId);
            return $this->success(ProductResource::collection($products));
        }catch (\Throwable $th){
            return $this->serverError();
        }
    }

    public function create(CreateProductRequest $request){
        try {
            DB::beginTransaction();
            $product = $this->productRepo->create($request->only([
                'name','description','restaurant_id','category_id','price','image','sort'
            ]));
            if ($request->translations){
                foreach ($request->translations as $translation){
                    if ($this->productRepo->checkIfTranslationFound($product->id , $translation['lng'])){
                        continue;
                    }
                    $data = array_merge($translation , [
                        'product_id' => $product->id
                    ]);
                    $this->productRepo->createTranslation($data);
                }
            }
            DB::commit();
            return $this->success([
                'status' => true
            ]);
        }catch (\Throwable $th){
            DB::rollBack();
            return $this->serverError();
        }
    }

    public function delete($productId){
        try {

            $product  = $this->productRepo->show($productId);

            if (!$product){
                return $this->error('product not found' , 404);
            }

            $this->productRepo->delete($product);

            return $this->success([
                'status' => true,
                'product_id' => $product->id
            ]);
        }catch (\Throwable $th){
            return $this->serverError();
        }
    }

    public function update($productId , UpdateProductRequest $request){
        try {
            DB::beginTransaction();
            $product = $this->productRepo->show($productId);

            if (!$product){
                return $this->error('product not found' , 404);
            }

            $this->productRepo->update($request->only([
                'name','description','restaurant_id','category_id','price','image','sort'
            ]) , $product);

            $translationFailed = collect([]);

            if ($request->translations){
                foreach ($request->translations as $translation){
                    if ($this->productRepo->checkIfTranslationFound($product->id , $translation['lng'])){
                        $translationFailed->push($translation['lng'] . " already added");
                        continue;
                    }
                    $data = array_merge($translation , [
                        'product_id' => $product->id
                    ]);
                    $this->productRepo->createTranslation($data);
                }
            }
            DB::commit();
            return $this->success([
                'status' => true,
                'translations_failed' => $translationFailed
            ]);
        }catch (\Throwable $th){
            DB::rollBack();
            return $this->serverError($th);
        }
    }
}
