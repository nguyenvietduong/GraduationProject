<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'message', 'read'];

    // Nếu cần liên kết với người dùng
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
