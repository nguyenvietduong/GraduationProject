<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservation extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'code',
        'confirmation_code',
        'ipAddress',
        'name',
        'email',
        'phone',
        'reservation_time',
        'guests',
        'special_request',
        'status',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'reservation_time' => 'datetime',
    ];

    // Thiết lập quan hệ với ReservationDetail
    public function reservationDetails()
    {
        return $this->hasMany(ReservationDetail::class);
    }

    /**
     * Define a relationship to the Invoice model.
     */
    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
