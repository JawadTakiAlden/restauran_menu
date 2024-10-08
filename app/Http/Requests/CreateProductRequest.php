<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
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
            'name' => 'required|string',
            'description' => 'required|string',
            'image' => 'required|image',
            'price' => 'required|numeric',
            "restaurant_id" => 'required|exists:restaurants,id',
            'category_id' => 'required|exists:categories,id',
            'sort' => 'required|numeric',
            'translations' => 'array',
            'translations.*.lng' => 'required|string',
            'translations.*.name' => 'required|string',
            'translations.*.description' => 'required|string'
        ];
    }
}
