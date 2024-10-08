<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TemplateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $translations = $this->templateTranslations;
        return [
            'id' => $this->id,
            'name' => $this->name,
            'image' => $this->image,
            'template_colors' => $this->templateColors,
            'translations' => [
                'name' => $translations->pluck('name', 'lng')->merge([
                    'en' => $this->name
                ]),
            ],
            'created_at' => $this->created_at
        ];
    }
}
