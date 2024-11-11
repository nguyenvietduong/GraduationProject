<?php

namespace App\Http\Requests\Frontend\Reviews;

use App\Models\Reservation;
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
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:15',
        ];
    }
    
    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $invoiceExists = Reservation::where('phone', $this->phone)
                                        ->where('email', $this->email)
                                        ->where('name', $this->name)
                                        ->where('status', 'completed')
                                        ->exists();

            if (!$invoiceExists) {
                $validator->errors()->add('invoice', 'Thông tin hóa đơn không tồn tại');
            }
        });
    }
}
