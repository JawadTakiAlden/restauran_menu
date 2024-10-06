<?php

namespace App\Repositories\Category;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

interface CategoryRepoI
{
    public function getAll() : Collection;

    public function create(array $data) : Category;

    public function update(array $data , Category $category) : bool;

    public function delete(Category $category) : bool;

    public function show($id) : ?Category;

    public function getCategoryTree($parentId = null);

    public function createTranslation(array $data);

    public function checkIfTranslationFound(int $categoryId , string $lng) : bool;

}
