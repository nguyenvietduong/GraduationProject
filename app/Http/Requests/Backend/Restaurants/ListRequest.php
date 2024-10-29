<?php

namespace App\Http\Requests\BackEnd\Restaurants;

use App\Http\Requests\TraitRequest;
use Illuminate\Foundation\Http\FormRequest;

class ListRequest extends FormRequest
{
    use TraitRequest;

    /**
     * Prepare the data for validation.
     *
     * This method sets default values for pagination if they are not present
     * in the request, ensuring default values are set if they are missing.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->prepareForPagination();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * This ensures that 'page', 'per_page', and 'search' are validated.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'page'      => 'nullable|integer|min:1', // Page is optional but must be an integer >= 1
            'per_page'  => 'nullable|integer|min:5|max:200', // Ensure consistent naming
            'search'    => 'nullable|string|max:255', // Search term should be a string with a maximum length
        ];
    }
}
