<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

//    protected $fillable = ['name', 'price'];
//
//    public function shop()
//    {
//        return $this->belongsTo(Shop::class);
//    }
//    public function toppings()
//    {
//        return $this->belongsToMany(Topping::class);
//    }

    protected $fillable = ['name', 'price', 'shop_id'];

    public function toppings()
    {
        return $this->belongsToMany(Topping::class, 'menu_toppings');

    }

}
