<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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
        return [
            'name' => 'sometimes|string',
            'description' => 'sometimes|string',
            'image' => 'sometimes|image',
            'sort' => 'sometimes|numeric',
            'restaurant_id' => 'sometimes|numeric|exists:restaurants,id',
            'parent_id' => 'sometimes|numeric|exists:categories,id',
            'visibility' => 'sometimes|boolean',
            'translations' => 'array',
            'translations.*.lng' => 'required|string',
            'translations.*.name' => 'required|string',
            'translations.*.description' => 'required|string'
        ];
    }
}
