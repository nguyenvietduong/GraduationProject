<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservation extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'reservation_time',
        'guests',
        'special_request',
        'status',
        'reserved_until',
        'table_id'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'reservation_time' => 'datetime',
    ];

    /**
     * Define a relationship to the Invoice model.
     */
    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }

    public function table()
    {
        return $this->belongsTo(Table::class);
    }
}
