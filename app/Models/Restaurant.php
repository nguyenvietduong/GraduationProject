<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;


    protected  $fillable = [
        'name',
        'slug',
        'address',
        'phone',
        'opening_hours',
        'closing_time',
        'rating',
        'description',
        'google_map_link',
        'image',
    ];
}
