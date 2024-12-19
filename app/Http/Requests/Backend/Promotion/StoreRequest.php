<?php

namespace App\Http\Requests\Backend\Promotion;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'title' => 'required|string|max:255|unique:promotions',
            'code' => 'required|unique:promotions',
            'max_discount.*' => 'required',
            'min_order_value.*' => 'required',
            'total' => 'required',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|after:start_date',
            'discount.*' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Tiêu đề là trường bắt buộc.',
            'title.max' => 'Tiêu đề không được vượt quá 255 ký tự.',
            'title.unique' => 'Tiêu đề đã tồn tại.',
            'code.required' => 'Mã khuyến mãi là trường bắt buộc.',
            'code.unique' => 'Mã khuyến mãi đã tồn tại.',
            'max_discount.*.required' => 'Giảm giá tối đa là trường bắt buộc.',
            'min_order_value.*.required' => 'Giá trị đơn hàng tối thiểu là trường bắt buộc.',
            'total.required' => 'Tổng số lượng khuyến mãi là trường bắt buộc.',
            'start_date.required' => 'Ngày bắt đầu là trường bắt buộc.',
            'start_date.date' => 'Ngày bắt đầu phải là định dạng ngày hợp lệ.',
            'start_date.after_or_equal' => 'Ngày bắt đầu phải lớn hơn hoặc bằng ngày hiện tại.',
            'end_date.required' => 'Ngày kết thúc là trường bắt buộc.',
            'end_date.date' => 'Ngày kết thúc phải là định dạng ngày hợp lệ.',
            'end_date.after' => 'Ngày kết thúc phải lớn hơn ngày bắt đầu.',
            'discount.*.required' => 'Phần trăm giảm giá là trường bắt buộc.',
        ];
    }
}
