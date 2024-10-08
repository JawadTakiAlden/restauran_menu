<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $translations = $this->productTranslations;
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'image' => $this->image,
            'restaurant_id' => $this->restaurant_id,
            'category_id' => $this->category_id,
            'translations' => [
                'name' => $translations->pluck('name', 'lng')->merge([
                    'en' => $this->name
                ]),
                'description' => $translations->pluck('description', 'lng')->merge([
                    'en' => $this->description
                ]),
            ],
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
