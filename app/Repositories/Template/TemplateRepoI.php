<?php

namespace App\Repositories\Template;

use App\Models\Template;
use Illuminate\Database\Eloquent\Collection;

interface TemplateRepoI
{
    public function getAll() : Collection;

    public function delete(Template $template) : bool;

    public function show($id) : Template;

    public function createTranslation(array $data);

    public function checkIfTranslationFound(int $templateId , string $lng) : bool;

    public function createColor(array $data);

    public function checkIfColorFound(int $templateId , string $colorKey) : bool;
}
