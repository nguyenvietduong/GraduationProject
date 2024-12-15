<?php

namespace App\Http\Requests\Frontend\Reservation;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
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
        Validator::extend('valid_guests', function ($attribute, $value, $parameters, $validator) {
            // Lấy tổng số bàn hiện tại
            $totalTables = \App\Models\Table::sum('capacity'); // Tổng sức chứa tất cả các bàn
            
            // Kiểm tra số lượng khách có vượt sức chứa không
            return $value <= $totalTables;
        });
    
        return [
            'name' => 'required|string|max:255|regex:/^[\pL\s\-]+$/u',
            'email' => 'required|email|max:255',
            'phone' => 'required|numeric|digits_between:10,11',
            'guests' => 'required|integer|min:1|max:100|valid_guests', // Áp dụng custom rule
            'date' => 'required|date|after_or_equal:today',
            'input-time' => 'required|date_format:H:i',
            'special_request' => 'nullable|string|max:500',
        ];
    }

    /**
     * Get custom attribute names for validation error messages.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'name' => 'họ và tên',              
            'email' => 'địa chỉ email',        
            'phone' => 'số điện thoại',         
            'guests' => 'số lượng khách',    
            'date' => 'ngày đặt chỗ',      
            'input-time' => 'giờ đặt chỗ', 
            'special_request' => 'yêu cầu đặc biệt', 
        ];
    }

    /**
     * Get custom validation messages.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Vui lòng nhập họ và tên.',
            'name.string' => 'Họ và tên phải là một chuỗi ký tự.',
            'name.max' => 'Họ và tên không được vượt quá 255 ký tự.',
            'name.regex' => 'Họ và tên chỉ được chứa ký tự chữ, khoảng trắng và dấu gạch ngang.',
            
            'email.required' => 'Vui lòng nhập địa chỉ email.',
            'email.email' => 'Địa chỉ email không hợp lệ.',
            'email.max' => 'Địa chỉ email không được vượt quá 255 ký tự.',
            
            'phone.required' => 'Vui lòng nhập số điện thoại.',
            'phone.numeric' => 'Số điện thoại phải là dạng số.',
            'phone.digits_between' => 'Số điện thoại phải có từ 10 đến 11 chữ số.',
            
            'guests.required' => 'Vui lòng nhập số lượng khách.',
            'guests.integer' => 'Số lượng khách phải là một số nguyên.',
            'guests.min' => 'Số lượng khách ít nhất là 1.',
            'guests.max' => 'Số lượng khách không được vượt quá 100.',
            
            'date.required' => 'Vui lòng nhập ngày đặt chỗ.',
            'date.date' => 'Ngày đặt chỗ không hợp lệ.',
            'date.after_or_equal' => 'Ngày đặt chỗ phải là hôm nay hoặc sau đó.',
            
            'input-time.required' => 'Vui lòng nhập giờ đặt chỗ.',
            'input-time.date_format' => 'Giờ đặt chỗ phải theo định dạng HH:mm.',
            
            'special_request.string' => 'Yêu cầu đặc biệt phải là một chuỗi ký tự.',
            'special_request.max' => 'Yêu cầu đặc biệt không được vượt quá 500 ký tự.',
        ];
    }
}
