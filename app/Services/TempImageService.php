<?php

namespace App\Services;

use App\Interfaces\Services\TempImageServiceInterface;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class TempImageService implements TempImageServiceInterface
{
    public function deleteTempImagesForUser()
    {
        // Xác định đường dẫn thư mục tạm của người dùng
        $tempImagePath = "temp_images/" . auth()->id() . "/"; // Đường dẫn tạm cho người dùng hiện tại

        // Kiểm tra nếu thư mục tồn tại
        if (Storage::exists($tempImagePath)) {
            // Lấy danh sách tất cả các tệp trong thư mục
            $files = Storage::files($tempImagePath);
            
            // Xóa tất cả các tệp trong thư mục
            foreach ($files as $file) {
                Storage::delete($file); // Xóa từng tệp
            }

            // Xóa giá trị tạm trong session
            Session::forget('image_temp');

            return ['message' => 'Đã xóa tất cả tệp tạm thời trong thư mục cho người dùng.'];
        }

        return ['message' => 'Thư mục tạm thời không tồn tại.'];
    }
}
