<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['shop_id', 'payment'];
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
}
