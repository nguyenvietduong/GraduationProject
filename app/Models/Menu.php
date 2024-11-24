<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Menu extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $appends = ['favorited'];
    protected $fillable = [
        "name",
        "price",
        "description",
        "category_id",
        "image_url",
        "slug",
        "status"
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'table_id', 'id');
    }

    public function getFavoritedAttribute()
    {
        $favorited = Favorite::where(['menu_id' => $this->id,  'user_id' => auth()->id()])->first();
        return $favorited ? true : false;
    }

    public function invoiceItems()
    {
        return $this->hasMany(Invoice_item::class, 'menu_id', 'id');
    }

    public static function getBestSellers($limit = 1)
    {
        return self::withCount(['invoiceItems as total_quantity' => function ($query) {
            $query->select(DB::raw('SUM(quantity)'));
        }])
            ->orderByDesc('total_quantity')
            ->take($limit)
            ->get();
    }

    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites');
    }
}
