<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderMenu extends Model
{
    protected $guarded = [];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function orderOptions()
    {
        return $this->hasMany(OrderOption::class);
    }
}
