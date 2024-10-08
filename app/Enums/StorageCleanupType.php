<?php

namespace App\Enums;

enum StorageCleanupType: string
{
    case Temporary = 'temporary'; // Xóa các giá trị tạm
    case Permanent = 'permanent'; // Xóa vĩnh viễn
    case Expired = 'expired'; // Xóa các giá trị đã hết hạn

    // Phương thức để lấy mô tả cho mỗi loại xóa
    public function getDescription(): string
    {
        return match ($this) {
            self::Temporary => 'Xóa các tệp tạm thời.',
            self::Permanent => 'Xóa các tệp vĩnh viễn.',
            self::Expired => 'Xóa các tệp đã hết hạn.',
        };
    }
}
