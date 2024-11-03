<?php

namespace App\Http\Requests\Frontend\Reservation;

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
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|numeric',
            'guests' => 'required|integer|min:1',
            'date' => 'required|date|after_or_equal:today',
            'input-time' => 'required|string',  // Ensure the input time is required
            'special_request' => 'nullable|string|max:500', // Make this optional with a max length
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
            'name' => 'full name',            // Customize the name for the 'name' attribute
            'email' => 'email address',        // Customize the name for the 'email' attribute
            'phone' => 'phone number',         // Customize the name for the 'phone' attribute
            'guests' => 'number of guests',    // Customize the name for the 'guests' attribute
            'date' => 'reservation date',      // Customize the name for the 'date' attribute
            'input-time' => 'reservation time', // Customize the name for the 'input-time' attribute
            'special_request' => 'special request', // Customize the name for the 'special_request' attribute
        ];
    }
}
