<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'capacity',
        'status',
        'description',
        'position',
    ];

    protected $casts = [
        'name' => 'array',         // Tự động giải mã JSON thành mảng
        'description' => 'array',  // Tự động giải mã JSON thành mảng
    ];

    public static $STATUS = [
        "available" => "Available",
        "reserved" => "Reserved",
        "occupied" => "Occupied"
    ];

    /**
     * Lấy tên theo ngôn ngữ hiện tại
     */
    public function getLocalizedNameAttribute($locale)
    {
        $locale = $locale ?? app()->getLocale();
        // Decode the JSON string into an associative array
        $name = json_decode($this->name, true);
        return $name[$locale] ?? 'No Name Available';
    }

    /**
     * Lấy mô tả theo ngôn ngữ hiện tại
     */
    public function getLocalizedDescriptionAttribute($locale)
    {
        $locale = $locale ?? app()->getLocale();
        // Decode the JSON string into an associative array
        $description = json_decode($this->description, true);
        return $description[$locale] ?? 'No Description Available';
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
