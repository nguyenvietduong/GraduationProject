<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'rating',
        'comment',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class); // Giả sử bạn có model User
    }

    public function countNewReviews(): int
    {
        return Review::where('status', 'pending')->count(); // Adjust the condition based on your criteria
    }
}
