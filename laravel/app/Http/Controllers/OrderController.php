<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Notice;
use App\Models\NoticeMenu;
use App\Models\Menu;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function create($shopId)
    {
        $latestNotice = Notice::where('shop_id', $shopId)->latest('created_at')->first();

        if (!$latestNotice) {
            return view('order.main', ['noticeMenus' => collect()]);
        }
        $noticeMenus = NoticeMenu::with('menu')
            ->where('notice_id', $latestNotice->id)
            ->get();

        return view('order.main', [
            'noticeMenus' => $noticeMenus,
        ]);
    }
    public function show($noticeMenuId)
    {
        $noticeMenu = NoticeMenu::with(['menu'])->findOrFail($noticeMenuId);

        $discountedPrice = $noticeMenu->menu->price - $noticeMenu->discount;

        $times = [];
        for ($time = Carbon::createFromTime(11, 0); $time->lessThan(Carbon::createFromTime(15, 0)); $time->addMinutes(15)) {
            $times[] = $time->format('H:i');
        }

        return view('order.detail.show', [
            'noticeMenu' => $noticeMenu,
            'discountedPrice' => $discountedPrice,
            'times' => $times
        ]);
    }
}
