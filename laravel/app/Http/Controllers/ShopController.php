<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Menu;
use App\Models\Option;

class ShopController extends Controller
{
    public function create()
    {
        return view('shop.form');
    }
    public function store(Request $request)
    {
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
            if ($menuName && $menuPrice) {
                $shop->menus()->create([
                    'name' => $menuName,
                    'price' => $menuPrice,
                ]);
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
        return redirect()->route('shop.confirm'); // 成功時のリダイレクト先を指定
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
