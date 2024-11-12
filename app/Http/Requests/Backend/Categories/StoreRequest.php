<?php

namespace App\Http\Requests\BackEnd\Categories;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the Account is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true; // Adjust this if you need to check for access permissions
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'  => 'required',
            'slug'     => 'required|string|max:255|unique:categories',
            'status'   => 'required'
        ];
    }

    /**
     * Get the custom attribute names for the validation errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'name'  => 'category name ', // This will replace 'name' in error messages
            'slug'     => 'slug',
            'status'   => 'status'
        ];
    }
}
