<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Menu;
use App\Models\Option;
use Illuminate\Support\Facades\Log;

class ShopController extends Controller
{
    public function create()
    {
        $menus = Menu::all();
        return view('shop.form', compact('menus'));
    }
    public function store(Request $request)
    {
        Log::debug('Current user ID: ' . auth()->id());
        // 店舗情報
        $validatedShopData = $request->validate([
            'name' => 'required|max:255',
            'contact' => 'required|max:255',
        ]);
        $shop = Shop::create([
            'name' => $validatedShopData['name'],
            'contact' => $validatedShopData['contact'],
            'user_id' => auth()->id()
        ]);

        // メニュー情報
        for ($i = 1; $i <= 3; $i++) {
            $menuName = $request->input("menu{$i}");
            $menuPrice = $request->input("menu{$i}-price");
            $toppings = $request->input("menu{$i}-toppings", []); // トッピング情報を配列で受け取る

            if ($menuName && $menuPrice) {
                $menu = $shop->menus()->create([
                    'name' => $menuName,
                    'price' => $menuPrice,
                ]);

                // トッピング情報を保存
                foreach ($toppings as $toppingId) {
                    $menu->toppings()->attach($toppingId); // menu_toppings テーブルにレコードを追加
                }
            }
        }

        //  オプション
        for ($i = 1; $i <= 3; $i++) {
            $optionName = $request->input("option{$i}");
            $optionPrice = $request->input("option{$i}-price");
            if ($optionName && $optionPrice) {
                $shop->options()->create([
                    'name' => $optionName,
                    'price' => $optionPrice,
                ]);
            }
        }

        // 保存後のリダイレクトなどの処理
        return redirect()->route('shops.confirm'); // 成功時のリダイレクト先を指定
    }
    public function confirm()
    {
        return view('shop.confirm');
    }

//    public function edit(Shop $shop)
//    {
//        return view('shop.edit', compact('shop'));
//    }
//
//    public function update(Request $request, Shop $shop)
//    {
//        $validatedData = $request->validate([
//            'name' => 'required|max:255',
//            'contact' => 'required|max:255',
//        ]);
//
//        $shop->update($validatedData);
//
//        return redirect()->route('shops.confirm');
//    }
}
