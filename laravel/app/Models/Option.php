<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price'];

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
}
