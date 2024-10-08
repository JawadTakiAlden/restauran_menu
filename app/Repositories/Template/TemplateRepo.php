<?php

namespace App\Repositories\Template;

use App\Models\Template;

class TemplateRepo implements TemplateRepoI
{
    public function show($id): Template
    {
        return Template::where('id' , $id)->first();
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
}
