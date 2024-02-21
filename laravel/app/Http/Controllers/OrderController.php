<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Notice;
use App\Models\NoticeMenu;
use App\Models\Menu;
use Carbon\Carbon;
use App\Models\Option;

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

        $shopId = $noticeMenu->notice->shop_id;

        $options = Option::where('shop_id', $shopId)->get();

        $times = [];
        for ($time = Carbon::createFromTime(11, 0); $time->lessThan(Carbon::createFromTime(15, 0)); $time->addMinutes(15)) {
            $times[] = $time->format('H:i');
        }

        return view('order.detail.show', [
            'noticeMenu' => $noticeMenu,
            'discountedPrice' => $discountedPrice,
            'times' => $times,
            'options' => $options
        ]);
    }
    public function storeDetail(Request $request, $noticeMenuId)
    {
        $quantity = $request->input('quantity');
        $selectedOptions = $request->input('selected_options');
        $orders = session('orders', []);
        $orders[$noticeMenuId] = [
            'quantity' => $quantity,
            'selected_options' => $selectedOptions,
        ];
        session(['orders' => $orders]);
        return redirect()->route('order.main', ['shopId' => $request->shop_id]);
    }
    public function confirm(Request $request)
    {
        $visitorInfo = [
            'tell' => $request->input('tell'),
            'visiting' => $request->input('visiting'),
            'note' => $request->input('note'),
        ];
        $orders = session('orders', []);
        // ここでorders_table、selected_menus_table、selected_toppings_tableへの保存処理を実装します。
        session()->forget('orders');
        return redirect()->route('order.final');
    }
    public function final()
    {
        return view('order.final');
    }
}
