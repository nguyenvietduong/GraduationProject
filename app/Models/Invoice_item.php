<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice_item extends Model
{
    use HasFactory;
    protected $fillable = [
        'invoice_id',
        'menu_id',
        'quantity',
        'price',
        'total',
    ];
    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
    
    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }
}
