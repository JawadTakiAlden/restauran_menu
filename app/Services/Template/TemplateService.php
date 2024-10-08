<?php

namespace App\Services\Template;

use App\Http\Resources\TemplateResource;
use App\HttpResponse\HTTPResponse;
use App\Models\Template;
use App\Repositories\Template\TemplateRepoI;

class TemplateService
{
    use HTTPResponse;
    public function __construct(protected TemplateRepoI $templateRepo)
    {
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
}
