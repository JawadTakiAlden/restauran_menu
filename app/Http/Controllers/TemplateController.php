<?php

namespace App\Http\Controllers;

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
}
