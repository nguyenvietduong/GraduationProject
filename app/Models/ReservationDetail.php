<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationDetail extends Model
{
    use HasFactory;

    protected $table = 'reservation_details'; // Nếu tên bảng không theo chuẩn

    protected $fillable = [
        'reservation_id',
        'table_id',
        'table_name',
        'guests_detail',
    ];

    // Thiết lập quan hệ ngược lại với Reservation
    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    // Thiết lập quan hệ với Table (bàn)
    public function table()
    {
        return $this->belongsTo(Table::class);
    }
}
