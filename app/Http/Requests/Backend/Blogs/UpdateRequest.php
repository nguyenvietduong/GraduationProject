<?php

namespace App\Http\Requests\Backend\Blogs;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage; // Thêm dòng này ở đầu file nếu chưa có
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true; // Thay đổi nếu cần kiểm tra quyền truy cập
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255|unique:blogs,title,' . $this->id, // Tiêu đề bài viết
            'content' => 'required|string', // Nội dung bài viết
            'slug' => 'nullable|string|max:255|unique:blogs,slug,' . $this->id, // Đường dẫn thân thiện, có thể null
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Hình ảnh bài viết
            'status' => 'required|in:active,inactive',
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
                $directory = "temp_blog_images/{$adminId}";
                $filePath = "{$directory}/{$fileName}";

                // Store the file in the temp_images folder
                Storage::put($filePath, file_get_contents($image->getRealPath()));

                // Save the file path in session
                session(['image_blog_temp' => $filePath]);
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
