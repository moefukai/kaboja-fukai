<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'contact', 'user_id'];

    public function menus()
    {
        return $this->hasMany(Menu::class);
    }
}
