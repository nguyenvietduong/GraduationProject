<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromotionUser extends Model
{
    use HasFactory;
    protected $table = 'promotion_user';  
    public $timestamps = false;
    protected $fillable = ['promotion_id', 'invoice_id'];
    
    public function promotion()
    {
        return $this->belongsTo(Promotion::class, 'promotion_id');
    }
    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }
}
