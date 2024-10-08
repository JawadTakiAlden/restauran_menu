<?php

namespace App\Repositories\Template;

use App\Models\Template;

interface TemplateRepoI
{
    public function getAll() : collection;
    public function delete(Template $template) : bool;
    public function show($id) : Template;

}
