<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Notice;
use App\Models\NoticeMenu;
use App\Models\Menu;
use App\Models\Topping;
use App\Models\Order;
use App\Models\OrderMenu;
use App\Models\OrderOption;
use Illuminate\Support\Facades\DB;
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
        session(['shop_id' => $shopId]);
        return view('order.detail.show', [
            'shopId' => $shopId,
            'noticeMenu' => $noticeMenu,
            'discountedPrice' => $discountedPrice,
            'times' => $times,
            'options' => $options
        ]);
    }

    public function storeDetail(Request $request)
    {
        DB::beginTransaction();

        try {
            $order = new Order();
            $order->tell = $request->input('tell');
            $order->visiting_time = $request->input('visiting_time');
            $order->note = $request->input('note');
            $order->total_price = 0;
            $order->save();

            $totalPrice = 0;

            foreach ($request->input('menus') as $menu) {
                $orderMenu = new OrderMenu();
                $orderMenu->order_id = $order->id;
                $orderMenu->notice_menu_id = $menu['menuId'];
                $orderMenu->save();

                if (isset($menu['options'])) {
                    foreach ($menu['options'] as $optionId) {
                        $orderOption = new OrderOption();
                        $orderOption->order_menu_id = $orderMenu->id;
                        $orderOption->option_id = $optionId;
                        $orderOption->save();

                        $option = Option::find($optionId);
                        $totalPrice += $option->price;
                    }
                }

                $noticeMenu = NoticeMenu::find($menu['menuId']);
                $discountedPrice = $noticeMenu->menu->price - $noticeMenu->discount;
                $totalPrice += $discountedPrice;
            }

            $order->total_price = $totalPrice;
            $order->save();

            DB::commit();

            $action = $request->input('action');
            if ($action == 'add_more') {
                $shopId = session('shop_id');
                return redirect()->route('order.main', ['shop_id' => $shopId]);
            } elseif ($action == 'confirm_order') {
                return redirect()->route('order.confirm');
            } else {
                return back()->with('error', '不明なアクションです。');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', '注文処理中にエラーが発生しました。');
        }
    }

    public function storeVisitorInfo(Request $request)
    {
        DB::beginTransaction();

        try {
            $order = new Order();
            $order->tell = $request->input('tell');
            $order->visiting_time = $request->input('visiting_time');
            $order->note = $request->input('note');
            $order->total_price = 0;
            $order->save();

            DB::commit();

            $action = $request->input('action');
            if ($action == 'add_more') {
                $shopId = session('shop_id');
                return redirect()->route('order.main', ['shop_id' => $shopId]);
            } elseif ($action == 'confirm_order') {
                return redirect()->route('order.confirm');
            } else {
                return back()->with('error', '不明なアクションです。');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', '注文処理中にエラーが発生しました。');
        }
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
