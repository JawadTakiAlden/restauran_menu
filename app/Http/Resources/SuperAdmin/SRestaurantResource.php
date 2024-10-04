<?php

namespace App\Http\Resources\SuperAdmin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SRestaurantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $translations = collect($this->restaurantTranslations());
        return [
          'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'logo' => $this->logo,
            'cover' => $this->cover,
            'is_pending' => $this->is_pending,
            'is_offer_shown' => $this->is_offer_shown,
            'template' => $this->template,
            'user' => $this->user,
            'expiry_date_subscription' => $this->subscription->expiry_date,
            'subscription' => $this->subscription,
            'translation' => [
                'name' => $translations->map(function ($translation) {
                    return [
                        $translation['lng'] => $translation['name'],
                    ];
                })->merge([
                    'en' => $this->name
                ]),
                'description' => $translations->map(function ($translation) {
                    return [
                        $translation['lng'] => $translation['description'],
                    ];
                })->merge([
                    'en' => $this->description
                ]),
            ]
        ];
    }
}
