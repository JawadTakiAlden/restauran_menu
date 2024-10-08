<?php

namespace App\Repositories\Template;

use App\Models\Template;
use App\Models\TemplateColor;
use App\Models\TemplateTranslation;
use Illuminate\Database\Eloquent\Collection;

class TemplateRepo implements TemplateRepoI
{
    public function show($id): Template
    {
        return Template::where('id' , $id)->first();
    }
    public function createTranslation(array $data)
    {
        return TemplateTranslation::create($data);
    }
    public function checkIfTranslationFound(int $templateId, string $lng): bool
    {
        return TemplateTranslation::where([
            'template_id' => $templateId,
            'lng' => $lng
        ])->exists();
    }

    public function createColor(array $data)
    {
        return TemplateColor::create($data);
    }

    public function checkIfColorFound(int $templateId, string $colorKey): bool
    {
        return TemplateColor::where([
            'template_id' => $templateId,
            'key' => $colorKey
        ])->exists();
    }
    public function getAll(): Collection
    {
        $templates=Template::all();
        return $templates;
    }
    public function delete(Template $template) : bool
    {
        $template->delete();
        return true;
    }

    public function createTemplate(array $data) : Template
    {
        return Template::create($data);
    }
}
