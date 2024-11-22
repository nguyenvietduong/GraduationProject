<?php

namespace App\Http\Requests\Backend\Menus;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the Account is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true; // Adjust this if you need to check for access permissions
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'slug' => 'required|string|unique:menus',
            'price' => 'required|numeric|between:0,99999999.99',
            'category_id' => 'required|integer|exists:categories,id',
            'image_url' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
            'status' => 'required|in:active,inactive'
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
            'name' => 'tên món ăn',
            "slug" => "dường dẫn",
            'price' => 'giá',
            'description' => 'mô tả',
            'category_id' => 'danh mục',
            'image_url' => 'ảnh',
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        // Check if an image was uploaded
        if ($this->hasFile('image')) {
            $image = $this->file('image');

            // Ensure the admin is authenticated
            if (Auth::check()) {
                $adminId = Auth::user()->id; // Get the authenticated admin ID

                // Generate a unique file name
                $fileName = $this->generateUniqueFileName($image);

                // Define the directory path
                $directory = "temp_images/{$adminId}";
                $filePath = "{$directory}/{$fileName}";

                // Store the file in the temp_images folder
                Storage::put($filePath, file_get_contents($image->getRealPath()));

                // Save the file path in session
                session(['image_temp' => $filePath]);
            }
        }

        // Redirect back with validation errors and input
        throw new HttpResponseException(
            redirect()->back()->withErrors($validator)->withInput()
        );
    }

    private function generateUniqueFileName(UploadedFile $file): string
    {
        $timestamp = time();
        $extension = $file->getClientOriginalExtension();
        $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        return "{$fileName}_{$timestamp}.{$extension}";
    }
}
