<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'price' => 'sometimes|numeric',
            "restaurant_id" => 'sometimes|exists:restaurants,id',
            'category_id' => 'sometimes|exists:categories,id',
            'sort' => 'sometimes|numeric',
            'translations' => 'array',
            'translations.*.lng' => 'required|string',
            'translations.*.name' => 'required|string',
            'translations.*.description' => 'required|string'
        ];
    }
}
