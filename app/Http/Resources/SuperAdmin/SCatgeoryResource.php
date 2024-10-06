<?php

namespace App\Http\Resources\SuperAdmin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SCatgeoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'image' => $this->image,
            'visibility' => $this->visibility,
            'is_parent' => collect($this->categories)->isNotEmpty(),
            'subCategories' => SCatgeoryResource::collection($this->categories)
        ];
    }
}
