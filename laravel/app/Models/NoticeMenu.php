<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NoticeMenu extends Model
{
    protected $fillable = ['notice_id', 'menu_id', 'discount'];

    public function notice()
    {
        return $this->belongsTo(Notice::class);
    }

    public function noticeToppings()
    {
        return $this->hasMany(NoticeTopping::class, 'notice_menu_id');
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function toppings()
    {
        return $this->hasMany(NoticeTopping::class, 'notice_menu_id');
    }
}
