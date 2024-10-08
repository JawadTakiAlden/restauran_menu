<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTemplateColorRequest;
use App\Http\Requests\CreateTemplateTranslationRequest;
use App\Models\Template;
use App\Services\Template\TemplateService;
use Illuminate\Http\Request;

class TemplateController extends Controller
{
    public function __construct(protected TemplateService $templateService)
    {
    }

    public function show(int $templateId){
       return $this->templateService->show($templateId);
   }

   public function createTranslations(int $templateId , CreateTemplateTranslationRequest $request){
        return $this->templateService->createTranslations($templateId , $request);
   }

   public function createTemplateColors(int $templateId , CreateTemplateColorRequest $request){
        return $this->templateService->createColors($templateId, $request);
    }
   public function getAll(){
        return $this->templateService->getAll();
   }
   public function delete(int $id)
   {
       return $this->templateService->delete($id);
   }
}
