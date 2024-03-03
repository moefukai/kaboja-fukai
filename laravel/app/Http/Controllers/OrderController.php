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
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function saveNoticeMenuId(Request $request)
    {
        $request->session()->put('selected_notice_menu_id', $request->input('noticeMenuId'));

        return response()->json(['success' => true]);
    }
    public function create(Request $request, $shopId)
    {
        session(['showNavigation' => false]);

        $latestNotice = Notice::where('shop_id', $shopId)->latest('created_at')->first();

        if (!$latestNotice) {
            return view('order.main', ['noticeMenus' => collect()]);
        }

        $noticeMenus = NoticeMenu::with('menu')
            ->where('notice_id', $latestNotice->id)
            ->get();

        $selectedNoticeMenuId = $request->input('selected_notice_menu_id');
        session(['selected_notice_menu_id' => $selectedNoticeMenuId]);

        return view('order.main', [
            'noticeMenus' => $noticeMenus,
        ]);
    }
    public function showDetail($noticeMenuId)
    {
        Log::info('NoticeMenuId:', ['noticeMenuId' => $noticeMenuId]);

        $noticeMenu = NoticeMenu::with('menu')->findOrFail($noticeMenuId);
        Log::info('Retrieved NoticeMenu:', ['noticeMenu' => $noticeMenu]);

        $discountedPrice = $noticeMenu->menu->price - $noticeMenu->discount;
        $shopId = $noticeMenu->notice->shop_id;
        $options = Option::where('shop_id', $shopId)->get();

        return view('order.detail.show', [
            'shopId' => $shopId,
            'noticeMenu' => $noticeMenu,
            'discountedPrice' => $discountedPrice,
            'options' => $options,
        ]);
    }


    public function storeDetail(Request $request)
    {
        Log::info('Received request data:', $request->all());
        DB::beginTransaction();
        $currentDate = date('Y-m-d');
        $visitingDateTime = $currentDate . ' ' . $request->input('visiting_time') . ':00';
        $noticeMenuId = $request->input('notice_menu_id');
        $noticeMenu = NoticeMenu::findOrFail($noticeMenuId);
        $menuPrice = $noticeMenu->menu->price;
        $discount = $noticeMenu->discount ?? 0;
        $discountedMenuPrice = $menuPrice - $discount;
        $selectedOptionIds = $request->input('options', []);
        $optionsTotalPrice = Option::whereIn('id', $selectedOptionIds)
            ->get()
            ->sum('price');
        $totalPrice = $discountedMenuPrice + $optionsTotalPrice;

        try {
            $order = new Order([
                'tell' => $request->input('tell'),
                'visiting_time' => $visitingDateTime,
                'note' => $request->input('note'),
                'total_price' => $totalPrice,
                'status' => 1,
                'shop_id' => $request->input('shop_id'),
            ]);
            $order->save();
            $orderMenu = new OrderMenu([
                'order_id' => $order->id,
                'notice_menu_id' => $noticeMenuId,
            ]);
            $orderMenu->save();
            foreach ($selectedOptionIds as $optionId) {
                $orderOption = new OrderOption([
                    'order_menu_id' => $orderMenu->id,
                    'option_id' => $optionId,
                ]);
                $orderOption->save();
            }
            Log::info('Order created.', ['order_id' => $order->id]);
            DB::commit();
            return redirect()->route('order.confirm', ['orderId' => $order->id]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Order processing failed.', ['error' => $e->getMessage()]);
            return back()->with('error', '注文処理中にエラーが発生しました。');
        }
    }
    public function confirm($orderId)
    {
        $order = Order::with(['orderMenus.noticeMenu', 'orderMenus.orderOptions.option'])->findOrFail($orderId);

        $noticeMenu = null;
        $discountedPrice = 0;
        $selectedOptions = [];
        $totalPrice = 0;

        if ($order->orderMenus->isNotEmpty()) {
            foreach ($order->orderMenus as $orderMenu) {
                $noticeMenu = $orderMenu->noticeMenu;
                if ($noticeMenu) {
                    $menuPrice = $noticeMenu->menu->price ?? 0;
                    $discount = $noticeMenu->discount ?? 0;
                    $menuDiscountedPrice = $menuPrice - $discount;
                    $discountedPrice += $menuDiscountedPrice;
                }
                foreach ($orderMenu->orderOptions as $orderOption) {
                    $selectedOptions[] = $orderOption->option;
                    $totalPrice += $orderOption->option->price ?? 0;
                }
            }
            $totalPrice += $discountedPrice;
        }

        $visitingTime = $order->visiting_time;
        $tell = $order->tell;
        $note = $order->note ?? 'なし';
        $shopId = $order->shop_id;

        return view('order.confirm', compact('order', 'noticeMenu', 'discountedPrice', 'selectedOptions', 'totalPrice', 'visitingTime', 'tell', 'note', 'shopId'));
    }
    public function final(Request $request, $orderId)
    {
        $order = Order::with('shop')->findOrFail($orderId);

        $shop = $order->shop;

        $latestNotice = $shop->notices()->latest()->first();

        $address = $latestNotice ? $latestNotice->address : '未定';

        return view('order.final', [
            'orderId' => $order->id,
            'shopName' => $shop->name,
            'address' => $address
        ]);
    }

    public function checkOrder(Request $request)
    {
        session(['showNavigation' => true]);

        $shopId = Auth::user()->shop()->id;
        $orders = Order::where('shop_id', $shopId)
        ->where('status', 1)
        ->orderBy('created_at', 'desc')
        ->paginate(1);

        return view('checkorder.main', compact('orders'));
    }
    public function updateStatus(Request $request, Order $order)
    {
        $statusMapping = [
            1 => 2,
            2 => 3,
        ];
        $nextStatus = isset($statusMapping[$order->status]) ? $statusMapping[$order->status] : $order->status;
        $order->update(['status' => $nextStatus]);
        return redirect()->back()->with('message', 'Order status updated successfully.');
    }

    public function showToServe(Request $request)
    {
        $shopId = Auth::user()->shop->id;
        $orders = Order::where('shop_id', $shopId)
            ->where('status', 2)
            ->orderBy('created_at', 'desc')
            ->paginate(1);
        return view('checkorder.toserve', compact('orders'));
    }
//    public function showVisitorInfo()
//    {
//        return view('order.visitor.show');
//    }

//    public function storeVisitorInfo(Request $request)
//    {
//        DB::beginTransaction();
//
//        $currentDate = date('Y-m-d');
//        $visitingDateTime = $currentDate . ' ' . $request->input('visiting_time') . ':00';
//
//        try {
//            $order = new Order();
//            $order->tell = $request->input('tell');
//            $order->visiting_time = $visitingDateTime;
//            $order->note = $request->input('note');
//            $order->total_price = 0;
//            $order->save();
//
//            DB::commit();
//
//            $action = $request->input('action');
//            if ($action == 'add_more') {
//                $shopId = session('shop_id');
//                return redirect()->route('order.main', ['shop_id' => $shopId]);
//            } elseif ($action == 'confirm_order') {
//                return redirect()->route('order.confirm');
//            } else {
//                return back()->with('error', '不明なアクションです。');
//            }
//        } catch (\Exception $e) {
//            DB::rollBack();
//            return back()->with('error', '注文処理中にエラーが発生しました。');
//        }
//    }

//    public function confirm(Request $request)
//    {
//        $visitorInfo = [
//            'tell' => $request->input('tell'),
//            'visiting' => $request->input('visiting'),
//            'note' => $request->input('note'),
//        ];
//        $orders = session('orders', []);
//        session()->forget('orders');
//        return redirect()->route('order.final');
//    }
//    public function final()
//    {
//        return view('order.final');
//    }
}
