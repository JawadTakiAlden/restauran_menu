<?php

namespace App\Services\Template;

use App\Http\Requests\CreateTemplateColorRequest;
use App\Http\Requests\CreateTemplateRequest;
use App\Http\Requests\CreateTemplateTranslationRequest;
use App\Http\Requests\UpdateTemplateRequest;
use App\Http\Resources\TemplateResource;
use App\HttpResponse\HTTPResponse;
use App\Models\Template;
use App\Repositories\Template\TemplateRepoI;
use Illuminate\Support\Facades\DB;

class TemplateService
{
    use HTTPResponse;
    public function __construct(protected TemplateRepoI $templateRepo)
    {
    }
    public function getAll()
    {
        try {
            return $this->success(TemplateResource::collection($this->templateRepo->getAll()));
        }
        catch (\Throwable $throwable)
        {
            return $this->serverError($throwable);
        }
    }
    public function show(int $templateId){
        try {
            $template = $this->templateRepo->show($templateId);
            if (!$templateId){
                return $this->error('template not found' ,404);
            }
            return $this->success(TemplateResource::make($template));
        }catch (\Throwable $th){
            return $this->serverError();
        }
    }
    public function createTranslations($templateId , CreateTemplateTranslationRequest $request){
        try {
            $template = $this->templateRepo->show($templateId);
            if (!$templateId){
                return $this->error('template not found' ,404);
            }
            $translationFailed = collect([]);
            if ($request->translations){
                foreach ($request->translations as $translation){
                    if ($this->templateRepo->checkIfTranslationFound($template->id , $translation['lng'])){
                        $translationFailed->push($translation['lng'] . " already added");
                        continue;
                    }
                    $data = array_merge($translation , [
                        'template_id' => $template->id
                    ]);
                    $this->templateRepo->createTranslation($data);
                }
            }
            return $this->success([
                'status' => true,
                'translations_failed' => $translationFailed
            ]);
        }catch (\Throwable $th){
            return $this->serverError($th);
        }
    }

    public function createColors(int $templateId , CreateTemplateColorRequest $request){
        try {
            $template = $this->templateRepo->show($templateId);
            if (!$templateId){
                return $this->error('template not found' ,404);
            }
            $colorsFailed = collect([]);
            if ($request->colors){
                foreach ($request->colors as $color){
                    if ($this->templateRepo->checkIfColorFound($template->id , $color['key'])){
                        $colorsFailed->push($color['key'] . " already added");
                        continue;
                    }
                    $data = array_merge($color , [
                        'template_id' => $template->id
                    ]);
                    $this->templateRepo->createColor($data);
                }
            }
            return $this->success([
                'status' => true,
                'colors_failed' => $colorsFailed
            ]);
        }catch (\Throwable $th) {
            return $this->serverError($th);
        }
    }
    public function delete(int $templateId)
    {
        try {
            DB::beginTransaction();
            $template = $this->templateRepo->show($templateId);
            if (!$template)
            {
                return $this->error('template not found',404);
            }
            $this->templateRepo->delete($template);
            DB::commit();
            return $this->success([
                "status" => true
            ]);
        }
        catch (\Throwable $throwable)
        {
            DB::rollback();
            return $this->serverError($throwable);
        }
    }

    public function createTemplate(CreateTemplateRequest $request)
    {
        try {
            DB::beginTransaction();
            $template = $this->templateRepo->createTemplate($request->only([
                'name', 'image'
            ]));
            $colorsFailed = collect([]);
            $translationFailed = collect([]);
            if ($request->colors) {
                foreach ($request->colors as $color) {
                    if ($this->templateRepo->checkIfColorFound($template->id, $color['key'])) {
                        $colorsFailed->push($color['key'] . " already added");
                        continue;
                    }
                    $data = array_merge($color, [
                        'template_id' => $template->id
                    ]);
                    $this->templateRepo->createColor($data);
                }
            }
            if ($request->translations) {
                foreach ($request->translations as $translation) {
                    if ($this->templateRepo->checkIfTranslationFound($template->id, $translation['lng'])) {
                        $translationFailed->push($translation['lng'] . " already added");
                        continue;
                    }
                    $data = array_merge($translation, [
                        'template_id' => $template->id
                    ]);
                    $this->templateRepo->createTranslation($data);
                }
            }
            DB::commit();
            return $this->success([
                "status" => true,
                'colors_failed' => $colorsFailed,
                'translations_failed' => $translationFailed]);
        } catch (\Throwable $throwable) {
            DB::rollback();
            return $this->serverError($throwable);
        }
    }
    public function updateTemplate(UpdateTemplateRequest $request,int $id)
    {
        try {
            $template=$this->templateRepo->show($id);
            if (!$template)
            {
                return $this->error("template not found",404);
            }
            $this->updateTemplate($request->only(['name','image']),$template);
            $translationfailed = collect([]);
            if ($request->translations){
                foreach ($request->translations as $translation){
                    if ($this->templateRepo->checkIfTranslationFound($template->id , $translation['lng'])){
                        $translationfailed->push($translation['lng'] . " already added");
                        continue;
                    }
                    $this->templateRepo->createTranslation(array_merge($translation , [
                        'template_id' => $template->id
                    ]));
                }
            }

            DB::commit();
            return $this->success([
                'message' => 'template updated successfully',
                'translation_failed' => $translationfailed
            ]);
        }
        catch (\Throwable $throwable)
        {
            DB::rollback();
            return $this->serverError($throwable);
        }
    }
}
