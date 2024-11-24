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
            'title' => 'required|string|max:255',
            'code' => 'required|unique:promotions',
            'max_discount.*' => 'required',
            'min_order_value.*' => 'required',
            'total' => 'required',
            'start_date' => 'required',
            'end_date' => 'nullable|after:start_date',
            'discount.*' => 'required',
        ];
    }
}
