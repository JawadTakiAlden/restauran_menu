<?php

namespace App\Repositories\Product;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

interface ProductRepoI
{
    public function getAll() : Collection;

    public function getProductOfCategory(int $categoryId) : Collection;

    public function show(int $productId) : Product;
//
    public function create(array $data) : Product;

    public function createTranslation(array $data);

    public function checkIfTranslationFound(string $productId , string $lng) : bool;

    public function update(array $data , Product $product);

    public function delete(Product $product) : Product;
}
