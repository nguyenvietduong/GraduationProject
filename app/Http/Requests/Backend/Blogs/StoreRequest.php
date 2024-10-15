<?php

namespace App\Http\Requests\Backend\Blogs;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true; // Điều chỉnh nếu cần kiểm tra quyền truy cập
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255|unique:blogs', // Tiêu đề bài viết
            'content' => 'required|string', // Nội dung bài viết
            'slug' => 'nullable|string|max:255|unique:blogs', // Đường dẫn thân thiện, có thể null
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Hình ảnh bài viết
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
            'title'     => 'tiêu đề bài viết', // Thay thế 'title' trong thông báo lỗi
            'content'   => 'nội dung bài viết', // Thay thế 'content' trong thông báo lỗi
            'slug'      => 'đường dẫn thân thiện', // Thay thế 'slug' trong thông báo lỗi
            'image'     => 'hình ảnh bài viết', // Thay thế 'image' trong thông báo lỗi
        ];
    }
}
