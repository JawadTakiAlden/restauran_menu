<?php

namespace App\Repositories\Template;

use App\Models\Template;

interface TemplateRepoI
{
    public function show($id) : Template;
}
