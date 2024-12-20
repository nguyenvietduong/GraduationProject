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
        'isExport'
    ];
    
    public function invoiceItems()
    {
        return $this->hasMany(Invoice_item::class);
    }

    public function promotionDetail()
    {
        return $this->hasOne(PromotionUser::class);
    }

    public function review()
    {
        return $this->hasOne(Review::class);
    }

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}
