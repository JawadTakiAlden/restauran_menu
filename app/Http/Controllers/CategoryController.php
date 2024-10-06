<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\CreateCategoryTranslationRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Services\Category\CategoryService;

class CategoryController extends Controller
{

    public function __construct(protected CategoryService $categoryService)
    {
    }

    public function getAll(){
       return $this->categoryService->getAll();
   }
    public function show($id){
        return $this->categoryService->show($id);
    }
    public function create(CreateCategoryRequest $request){
        return $this->categoryService->create($request);
    }
    public function update(UpdateCategoryRequest $request , $id){
        return $this->categoryService->update($request , $id);
    }
    public function delete($id){
        return $this->categoryService->delete($id);
    }

    public function createTranslations(CreateCategoryTranslationRequest $request , int $id){
        return $this->categoryService->createTranslations($request , $id);
    }
}
