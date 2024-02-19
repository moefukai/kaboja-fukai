<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoticeTopping extends Model
{
    use HasFactory;

    protected $fillable = ['notice_menu_id', 'topping_id'];

    public function noticeMenu()
    {
        return $this->belongsTo(NoticeMenu::class);
    }
}
