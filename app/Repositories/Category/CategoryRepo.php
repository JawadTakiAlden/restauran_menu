<?php

namespace App\Repositories\Category;

use App\Http\Resources\SuperAdmin\SCatgeoryResource;
use App\Models\Category;
use App\Models\CategoryTranslation;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepo implements CategoryRepoI
{
    public function getAll(): Collection
    {
        $categories = Category::all();
        return $categories;
    }

    public function getCategoryTree($parentId = null){
        $categories = Category::where('parent_id', $parentId)->get();

        foreach ($categories as $category) {
            $category->children = $this->getCategoryTree($category->id);
        }

        return SCatgeoryResource::collection($categories);
    }

    public function create(array $data) : Category
    {
       $category =  Category::create($data);
       return $category;
    }


    public function checkIfTranslationFound(int $categoryId , string $lng) : bool{
        return CategoryTranslation::where([
            'lng' => $lng,
            'category_id' => $categoryId
        ])->exists();
    }
    public function createTranslation(array $data) : CategoryTranslation
    {
        return CategoryTranslation::create($data);
    }

    public function delete(Category $category): bool
    {
        $category->delete();
        return true;
    }

    public function show($id): ?Category
    {
        return Category::where('id' , $id)->first();
    }

    public function update(array $data , Category $category) : bool
    {
        $category->update($data);
        return true;
    }
}
