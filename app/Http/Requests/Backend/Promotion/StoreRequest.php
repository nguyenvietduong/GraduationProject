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
            'title' => 'required|array', // Xác nhận rằng title là một mảng
            'title.*' => 'required|string|max:255',
            'code' => 'required|unique:promotions',
            'max_discount.*' => 'required',
            'min_order_value.*' => 'required',
            'total' => 'required',
            'start_date' => 'required',
            'end_date' => 'nullable|after:start_date',
            'discount.*' => 'required',
        ];
    }


    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $titles = $this->input('title'); // Lấy mảng title

            foreach ($titles as $lang => $title) {
                // Kiểm tra tiêu đề theo ngôn ngữ cụ thể bằng JSON_EXTRACT
                $exists = \DB::table('promotions')
                    ->whereRaw("JSON_UNQUOTE(JSON_EXTRACT(title, '$.\"$lang\"')) = ?", [$title])
                    ->exists();

                if ($exists) {
                    $validator->errors()->add("title.$lang", "The $lang language header already exists");
                }
            }
        });
    }


    // public function messages()
    // {
    //     return [
    //         'title.*.required' => 'Trường tiêu đề cho mỗi ngôn ngữ là bắt buộc',
    //         'min_order_value.*.required' => 'Trường tiền tối thiểu cho mỗi ngôn ngữ là bắt buộc',
    //         'discount.*.required' => 'Trường giảm giá cho mỗi ngôn ngữ là bắt buộc',
    //         'max_discount.*.required' => 'Trường tiền giảm tối đa cho mỗi ngôn ngữ là bắt buộc',

    //     ];
    // }
}
