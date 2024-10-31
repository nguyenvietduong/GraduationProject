<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        "name" ,
        "price" ,
        "description" ,
        "category_id" ,
        "image_url" ,
        "slug" ,
        "status"
    ];

    protected $casts = [
        "name" => "array", 
        "description" => "array", 
        "price" => "array" 
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'table_id','id');
    }
}