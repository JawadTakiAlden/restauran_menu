<?php

namespace App\Services\Category;

use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\CreateCategoryTranslationRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\SuperAdmin\SCatgeoryResource;
use App\HttpResponse\HTTPResponse;
use App\Models\CategoryTranslation;
use App\Repositories\Category\CategoryRepoI;
use Illuminate\Support\Facades\DB;

class CategoryService
{
    use HTTPResponse;
    public function __construct(protected CategoryRepoI $categoryRepo)
    {
    }

    public function getAll(){
        try {
            return $this->success(SCatgeoryResource::collection($this->categoryRepo->getAll()));
        }catch (\Throwable){
            return $this->serverError();
        }
    }

    public function create(CreateCategoryRequest $request){
        try {
            DB::beginTransaction();
            $category = $this->categoryRepo->create($request->only([
                'name' , 'description' , 'image' , 'sort' ,'restaurant_id' , 'parent_id','visibility'
            ]));

            if ($request->translations){
                foreach ($request->translations as $translation){
                    if ($this->categoryRepo->checkIfTranslationFound($category->id , $translation['lng'])){
                        continue;
                    }
                    $this->categoryRepo->createTranslation(array_merge($translation , [
                        'category_id' => $category->id
                    ]));
                }
            }
            DB::commit();
            return $this->success([
               'message' => 'category created successfully'
            ]);

        }catch (\Throwable){
            DB::rollBack();
            return $this->serverError();
        }
    }

    public function update(UpdateCategoryRequest $request , $id){
        try {
            DB::beginTransaction();
            $category = $this->categoryRepo->show($id);

            if (!$category){
                return  $this->error('category not found' , 404);
            }

            $category->update($request->only([
                'name',
                'description',
                'parent_id',
                'image',
                'visibility',
                'sort'
            ]));

            if ($request->translations){
                foreach ($request->translations as $translation){
                    if ($this->categoryRepo->checkIfTranslationFound($category->id , $translation['lng'])){
                        continue;
                    }
                    $this->categoryRepo->createTranslation(array_merge($translation , [
                        'category_id' => $category->id
                    ]));
                }
            }

            DB::commit();
            return $this->success([
                'message' => 'category updated successfully'
            ]);

        }catch (\Throwable){
            DB::rollBack();
            return $this->serverError();
        }
    }

    public function createTranslations(CreateCategoryTranslationRequest $request , $id){
        try {
            DB::beginTransaction();
            $category = $this->categoryRepo->show($id);

            if (!$category){
                return  $this->error('category not found' , 404);
            }
            if ($request->translations){
                foreach ($request->translations as $translation){
                    if ($this->categoryRepo->checkIfTranslationFound($category->id , $translation['lng'])){
                        continue;
                    }
                    $this->categoryRepo->createTranslation(array_merge($translation , [
                        'category_id' => $category->id
                    ]));
                }
            }
            DB::commit();
            return $this->success([
                'message' => 'category updated successfully'
            ]);
        }catch (\Throwable $th){
            DB::rollBack();
            return $this->serverError();
        }

    }

    public function delete($id){
        try {
            DB::beginTransaction();
            $category = $this->categoryRepo->show($id);
            if (!$category){
                return  $this->error('category not found' , 404);
            }
            $this->categoryRepo->delete($id);
            DB::commit();
            return $this->success([
                'status' => true
            ]);
        }catch (\Throwable){
            DB::rollBack();
            return $this->serverError();
        }
    }

    public function show($id){
        try {
            $category = $this->categoryRepo->show($id);
            return $this->success(SCatgeoryResource::make($category));
        }catch (\Throwable){
            return $this->serverError();
        }
    }
}
