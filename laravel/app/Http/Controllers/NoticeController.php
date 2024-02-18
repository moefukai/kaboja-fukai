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
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            // 日時のフォーマット変換
            $start_time = Carbon::createFromFormat('H:i', $request->start_time)->format('Y-m-d H:i:s');
            $end_time = Carbon::createFromFormat('H:i', $request->end_time)->format('Y-m-d H:i:s');

            // 店舗情報の取得
            $shop = Shop::where('user_id', Auth::id())->firstOrFail();

            // 通知情報の保存
            $notice = Notice::create([
                'shop_id' => $shop->id,
                'address' => $request->address,
                'start_time' => $start_time,
                'end_time' => $end_time,
            ]);

            $data = json_decode($request->getContent(), true);
            $menusData = $data['menus'] ?? null;
//            // メニュー情報の保存
//            $menusData = json_decode($request->input('menus'), true);

            if (is_array($menusData) && !empty($menusData)) {
                foreach ($menusData as $menuData) {
                    $noticeMenu = NoticeMenu::create([
                        'notice_id' => $notice->id,
                        'menu_id' => $menuData['menuId'],
                        'discount' => $menuData['discount'],
                    ]);

                    // トッピング情報の保存
                    if (!empty($menuData['toppings'])) {
                        foreach ($menuData['toppings'] as $toppingId) {
                            NoticeTopping::create([
                                'notice_menu_id' => $noticeMenu->id,
                                'topping_id' => $toppingId,
                            ]);
                        }
                    }
                }
            } else {
                // $menusData が配列ではない、または空の場合のエラー処理
                Log::error('Menus data is not an array or is empty.');
                return response()->json(['error' => 'Invalid menus data provided.'], 400);
            }

            DB::commit();
            return response()->json(['message' => 'Notice created successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function confirm()
    {
        return view('notice.confirm');
    }

    public function edit($id)
    {
        $notice = Notice::findOrFail($id);
        return view('notice.edit', compact('notice'));
    }
}
