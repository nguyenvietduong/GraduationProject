<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'rating',
        'comment',
        'status'
    ];

    public function countNewReviews(): int
    {
        return Review::where('status', 'pending')->count(); // Adjust the condition based on your criteria
    }

    public function invoice() {
        return $this->belongsTo(Invoice::class);
    }
}
