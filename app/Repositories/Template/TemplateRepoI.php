<?php

namespace App\Repositories\Template;

use App\Models\Template;

interface TemplateRepoI
{
    public function getAll() : Collection;
    public function delete(Template $template) : bool;
    public function show($id) : Template;

}
