<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use HasFactory, SoftDeletes; // Sử dụng SoftDeletes để hỗ trợ xóa mềm

    protected $fillable = [
        'title',     // Tiêu đề bài viết
        'content',   // Nội dung bài viết
        'slug',      // Đường dẫn thân thiện
        'image',     // Đường dẫn hình ảnh
        'user_id',   // ID của người dùng đăng bài
    ];

    // Phương thức để lấy người dùng tạo bài viết
    public function user()
    {
        return $this->belongsTo(User::class); // Giả sử bạn có model User
    }

    // Tự động tạo slug khi gán giá trị cho 'title'
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug(Str::ascii($value)); // Tạo slug từ title
    }

    // Phương thức để tạo slug từ tiêu đề
    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = \Str::slug(\Str::ascii($value)); // Chuyển đổi về dạng không dấu và tạo slug
    }
}
