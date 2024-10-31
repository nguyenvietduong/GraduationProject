<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'code',
        'description',
        'discount',
        'type',
        'min_order_value',
        'max_discount',
        'total',
        'is_active',
        'start_date',
        'end_date'
    ];

    protected $casts = [
        'title' => 'array', // hoặc 'json'
        'description' => 'array',
        'discount' => 'array',
        'min_order_value' => 'array',
        'max_discount' => 'array',
    ];
}
