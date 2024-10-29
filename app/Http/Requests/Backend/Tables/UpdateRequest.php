<?php

namespace App\Http\Requests\Backend\Tables;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
        $tableId = $this->route('id'); // Lấy ID của bàn từ route
        return [
            'name.en' => 'required|string|max:255', // Mỗi tên bàn phải là một chuỗi
            'name.vi' => 'required|string|max:255', // Mỗi tên bàn phải là một chuỗi
            'capacity' => 'required|integer|min:1', // Số người tối đa phải là số nguyên dương
            'status' => 'required|in:available,occupied,reserved,out_of_service', // Trạng thái phải nằm trong danh sách cho phép
            'description.en' => 'nullable|string|max:255', // Mỗi mô tả phải là một chuỗi, nếu có
            'description.vi' => 'nullable|string|max:255', // Mỗi mô tả phải là một chuỗi, nếu có
            'position' => 'required|string|regex:/^[A-H][1-8]$/|unique:tables,position,' . $tableId, // Vị trí bàn phải theo định dạng và không trùng, trừ bản ghi hiện tại
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
            'name' => 'Table name', // Thay thế 'name' trong thông báo lỗi
            'capacity' => 'Capacity', // Thay thế 'capacity' trong thông báo lỗi
            'status' => 'Status', // Thay thế 'status' trong thông báo lỗi
            'description' => 'Description', // Thay thế 'description' trong thông báo lỗi
            'position' => 'Position', // Thay thế 'position' trong thông báo lỗi
        ];
    }

    /**
     * Get the custom error messages for the validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.en.required' => __('validation.required', ['attribute' => __('attributes.name')]),
            'name.en.string' => __('validation.string', ['attribute' => __('attributes.name')]),
            'name.en.max' => __('validation.max', ['attribute' => __('attributes.name')]),
            'name.vi.required' => __('validation.required', ['attribute' => __('attributes.name')]),
            'name.vi.string' => __('validation.string', ['attribute' => __('attributes.name')]),
            'name.vi.max' => __('validation.max', ['attribute' => __('attributes.name')]),
            'capacity.required' => __('validation.required', ['attribute' => __('attributes.capacity')]),
            'capacity.integer' => __('validation.integer', ['attribute' => __('attributes.capacity')]),
            'capacity.min' => __('validation.min', ['attribute' => __('attributes.capacity')]),
            'status.required' => __('validation.required', ['attribute' => __('attributes.status')]),
            'status.in' => __('validation.in', ['attribute' => __('attributes.status')]),
            'description.en.string' => __('validation.string', ['attribute' => __('attributes.description')]),
            'description.en.max' => __('validation.max', ['attribute' => __('attributes.description')]),
            'description.vi.string' => __('validation.string', ['attribute' => __('attributes.description')]),
            'description.vi.max' => __('validation.max', ['attribute' => __('attributes.description')]),
            'position.required' => __('validation.required', ['attribute' => __('attributes.position')]),
            'position.regex' => __('validation.regex', ['attribute' => __('attributes.position')]).'A1,B2.... to H8.',
            'position.unique' => __('validation.unique', ['attribute' => __('attributes.position')]),
        ];
    }
}
