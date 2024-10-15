<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Services\ImageService;

class BlogController extends Controller
{
    protected $imageService;

    public function __construct(
        ImageService $imageService,
    ) {
        $this->imageService = $imageService;
    }

    public function uploadImage(Request $request)
    {
        // Kiểm tra xem có file được gửi không
        if ($request->hasFile('image')) { // Thay đổi 'image' thành tên field bạn sử dụng trong Summernote
            $newImagePath = $this->imageService->storeImage(
                'blog_image', // Thay đổi tên thư mục nếu cần
                $request->file('image') // Đảm bảo tên field này khớp với tên bạn đã gửi
            );
    
            // Trả về đường dẫn để Summernote chèn vào
            return response()->json(['link' => Storage::url($newImagePath)]);
        }
    
        return response()->json(['error' => 'No image uploaded'], 400);
    }
}
