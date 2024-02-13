<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'name', 'contact'];

    public function menus()
    {
        return $this->hasMany(Menu::class);
    }

    public function options()
    {
        return $this->hasMany(Option::class);
    }

}
