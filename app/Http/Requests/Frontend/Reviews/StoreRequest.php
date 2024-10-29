<?php

namespace App\Http\Requests\Frontend\Reviews;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

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
            'invoiceCode' => [
                'required',
                'string',
                function ($attribute, $value, $fail) {
                    $user = Auth::user();
                    $invoiceExists = $user->invoices()->where('id', $value)->exists();
    
                    if (!$invoiceExists) {
                        $fail(__('messages.system.invoice_error'));
                    }
                }
            ],
        ];
    }    
}
