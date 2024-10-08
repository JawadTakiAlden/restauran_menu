<?php

namespace App\Repositories\Template;

use App\Models\Template;

class TemplateRepo implements TemplateRepoI
{
    public function show($id): Template
    {
        return Template::where('id' , $id)->first();
    }
}
