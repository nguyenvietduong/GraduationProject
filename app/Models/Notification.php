<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'message', 'idUser'];

    public function user()
    {
        return $this->belongsTo(User::class, 'idUser'); // Change to belongsTo
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'notification_user')
                    ->withTimestamps();
    }      
}
