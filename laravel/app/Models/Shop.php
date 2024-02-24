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

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function options()
    {
        return $this->hasMany(Option::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function notices()
    {
        return $this->hasMany(Notice::class);
    }
}
