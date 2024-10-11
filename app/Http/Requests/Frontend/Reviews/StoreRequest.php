<?php

namespace App\Http\Requests\Frontend\Reviews;

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
        return true; // Bạn có thể thay đổi điều kiện này nếu cần kiểm tra quyền truy cập.
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'rating' => 'required|integer|min:1|max:5', // Đảm bảo rating từ 1 đến 5
            'comment' => 'nullable|string|max:1000', // Comment không bắt buộc và giới hạn 1000 ký tự
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
            'rating' => 'rating', // Tên hiển thị cho trường rating
            'comment' => 'comment', // Tên hiển thị cho trường comment
        ];
    }
}
