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

    public function noticeMenu()
    {
        return $this->belongsTo(NoticeMenu::class, 'notice_menu_id');
    }
}
