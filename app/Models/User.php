<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Carbon\Carbon;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'id',
        'full_name',
        'phone',
        'email',
        'image',
        'address',
        'password',
        'status',
        'code_sent',
        'birthday',
        'role_id',
        'session_id',
        'provider',
        'provider_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'birthday' => 'date', // Đảm bảo rằng `birthday` được cast sang kiểu `date`
    ];

    public function getBirthdayAttribute($value)
    {
        if (is_null($value)) {
            return null; // Trả về null nếu không có ngày sinh
        }

        // Kiểm tra ngôn ngữ hiện tại của ứng dụng
        $locale = app()->getLocale();

        if ($locale === 'vi') {
            // Định dạng cho ngôn ngữ Việt Nam: d/m/Y
            return Carbon::parse($value)->format('d/m/Y');
        } else {
            // Định dạng cho ngôn ngữ Anh: m/d/Y
            return Carbon::parse($value)->format('m/d/Y');
        }
    }

    // Custom roles relationship
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class); // Mỗi người dùng chỉ có một vai trò
    }
}
