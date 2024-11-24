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
    public function promotionUsers()
    {
        return $this->hasMany(PromotionUser::class, 'promotion_id');
    }
}
