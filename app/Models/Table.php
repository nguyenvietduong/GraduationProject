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

    public function reservationDetails()
    {
        return $this->hasMany(ReservationDetail::class, 'table_id');
    }
}
