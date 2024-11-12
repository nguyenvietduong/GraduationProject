<?php

namespace App\Http\Requests\BackEnd\Menus;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the Account is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Thay đổi này nếu cần kiểm tra quyền truy cập
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * The validation rules for this request ensure that the 'name' field is
     * required and must be a string with a maximum length of 200 characters.
     * This is useful for validating the data when updating an item.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'slug' => 'required|string|unique:menus,slug,' . $this->id,
            'price' => 'required|numeric|between:0,99999999.99',
            'description' => 'nullable',
            'category_id' => 'required|integer|exists:categories,id',
            'image_url' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'status' => 'required|in:active,inactive'
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
            'name' => 'tên món ăn',
            'price' => 'giá',
            'description' => 'mô tả',
            'category_id' => 'danh mục',
            'image_url' => 'ảnh',
        ];
    }
}
