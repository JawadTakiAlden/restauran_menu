<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRestaurantRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $restaurantId = $this->route('restaurant');
        return [
            'name' => 'sometimes|string|unique:restaurants,name,'.$restaurantId,
            'description' => 'sometimes|string|max:500',
            'logo' => 'image',
            'cover' => 'image',
            'username' => 'sometimes|string',
            'template_id' => 'sometimes|numeric|exists:templates,id',
            'is_offer_shown' => 'boolean',
            'is_pending' => 'boolean',
        ];
    }
}
