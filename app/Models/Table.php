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

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
