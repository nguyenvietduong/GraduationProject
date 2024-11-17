<?php

// App\Models\Invoice.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'reservation_id',
        'total_amount',
        'payment_method',
        'status',
    ];
    public function invoiceItems()
    {
        return $this->hasMany(Invoice_item::class);
    }
}
