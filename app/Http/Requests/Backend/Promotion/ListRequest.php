<?php

namespace App\Http\Requests\Backend\Promotion;

use App\Http\Requests\TraitRequest;
use Illuminate\Foundation\Http\FormRequest;

class ListRequest extends FormRequest
{
    use TraitRequest;

    /**
     * Determine if the user is authorized to make this request.
     */

    protected function prepareForValidation()
    {
        $this->prepareForPagination();
    }

    // public function authorize(): bool
    // {
    //     return true;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'page' => 'nullable|integer|min:1', // Page is optional but must be an integer >= 1
            'perpage' => 'nullable|integer|min:5|max:200', // Perpage should match how you're passing it in the controller
        ];
    }
}
