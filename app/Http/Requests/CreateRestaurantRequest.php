<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateRestaurantRequest extends FormRequest
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
            'name' => 'required|string|unique:restaurants,name',
            'description' => 'required|string|max:500',
            'logo' => 'image',
            'cover' => 'image',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string',
            'username' => 'required|string',
            'expiry_date' => 'required|date',
            'template_id' => 'required|numeric|exists:templates,id',
            'is_offer_shown' => 'boolean',
            'is_pending' => 'boolean'
        ];
    }
}
