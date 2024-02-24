<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Shop;

class Order extends Model
{
    protected $guarded = [];
    public function orderMenus()
    {
        return $this->hasMany(OrderMenu::class);
    }
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
}
