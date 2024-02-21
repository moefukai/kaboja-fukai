<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Menu;
use App\Models\Shop;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notice;
use App\Models\NoticeMenu;
use App\Models\NoticeTopping;
use Carbon\Carbon;

class NoticeController extends Controller
{
    public function create()
    {
        $shop = Shop::where('user_id', Auth::id())->first();
        if (!$shop) {
            return response()->json(['error' => 'このユーザーに対応する店舗が見つかりません。'], 404);
        }
        $menus = Menu::where('shop_id', $shop->id)->get();
        Log::info($shop);
        Log::info($menus);
        return view('notice.form', compact('menus', 'shop'));
    }

//    お知らせを作成する
    public function store(Request $request)
    {
        DB::beginTransaction();
        Log::info('受け取ったデータ:', $request->all());

        try {
            $start_time = Carbon::createFromFormat('H:i', $request->start_time)->format('Y-m-d H:i:s');
            $end_time = Carbon::createFromFormat('H:i', $request->end_time)->format('Y-m-d H:i:s');
            $shop = Shop::where('user_id', Auth::id())->firstOrFail();
            $notice = Notice::create([
                'shop_id' => $shop->id,
                'address' => $request->address,
                'start_time' => $start_time,
                'end_time' => $end_time,
            ]);

            $data = json_decode($request->getContent(), true);
            $menusData = $data['menus'] ?? null;

            if (is_array($menusData) && !empty($menusData)) {
                foreach ($menusData as $menuData) {
                    $noticeMenu = NoticeMenu::create([
                        'notice_id' => $notice->id,
                        'menu_id' => $menuData['menuId'],
                        'discount' => $menuData['discount'],
                    ]);
                }
            } else {
                Log::error('Menus data is not an array or is empty.');
                return response()->json(['error' => 'Invalid menus data provided.'], 400);
            }

            DB::commit();
            return response()->json(['redirect_url' => route('notice.confirm', ['id' => $notice->id])]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

//    確認画面を表示させる
    public function show($id)
    {
        $notice = Notice::findOrFail($id);
        $shop = Shop::findOrFail($notice->shop_id);
        $noticeMenus = NoticeMenu::with('menu')->where('notice_id', $notice->id)->get();
        foreach ($noticeMenus as $noticeMenu) {
            $toppings = NoticeTopping::with('topping')
                ->where('notice_menu_id', $noticeMenu->id)
                ->get()
                ->pluck('topping')
                ->pluck('name', 'id');
            $noticeMenu->menu->toppings = $toppings;
            $noticeMenu->menu->discountedPrice = $noticeMenu->menu->price - $noticeMenu->discount;
        }
        $start_time = Carbon::parse($notice->start_time)->format('H:i');
        $end_time = Carbon::parse($notice->end_time)->format('H:i');

        return view('notice.confirm', compact('shop', 'notice', 'noticeMenus', 'start_time', 'end_time'));
    }

    public function edit($id)
    {
        $notice = Notice::findOrFail($id);
        return view('notice.edit', compact('notice'));
    }
}
