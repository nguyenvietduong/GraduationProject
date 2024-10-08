<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    // Fields that are mass-assignable
    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'category',
        'meal_time',
        'image_url',
    ];
}
