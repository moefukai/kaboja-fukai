<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderOption extends Model
{
    protected $guarded = [];

    public function orderMenu()
    {
        return $this->belongsTo(OrderMenu::class);
    }

    public function option()
    {
        return $this->belongsTo(Option::class);
    }
}
