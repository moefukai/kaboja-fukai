<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    protected $fillable = ['shop_id', 'address', 'start_time', 'end_time'];

    public function shop()
    {
        return $this->belongsTo(Shop::class, 'shop_id');
    }
}
