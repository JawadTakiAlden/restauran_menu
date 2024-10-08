<?php

namespace App\Repositories\Product;

use App\Models\Product;
use App\Models\ProductTranslation;
use Illuminate\Database\Eloquent\Collection;

class ProductRepo implements ProductRepoI
{
    public function getAll() : Collection
    {
        return Product::all();
    }

    public function getProductOfCategory(int $categoryId) : Collection
    {
        return Product::where('category_id' , $categoryId)->get();
    }

    public function create(array $data) : Product
    {
        return Product::create($data);
    }

    public function createTranslation(array $data)
    {
        ProductTranslation::create($data);
    }

    public function checkIfTranslationFound(string $productId , string $lng) : bool {
        return ProductTranslation::where([
            'product_id' => $productId,
            'lng' => $lng
        ])->exists();
    }

    public function delete(Product $product): Product
    {
        $product->delete();
        return $product;
    }


    public function show(int $productId): Product
    {
        return Product::where('id' , $productId)->first();
    }

    public function update(array $data , Product $product)
    {
        $product->update($data);
    }
}
