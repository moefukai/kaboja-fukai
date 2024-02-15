<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Menu;
use App\Models\Topping;
use Illuminate\Support\Facades\Auth;
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
        $shop = Shop::create([
            'name' => $request->name,
            'contact' => $request->contact,
            'user_id' => Auth::id(), // ログインユーザーのIDを取得
        ]);

        foreach ($request->menus as $menuData) {
            Log::debug('Menu Name:', ['name' => $menuData['name']]);
            Log::debug('Menu Price:', ['price' => $menuData['price']]);
            $menu = $shop->menus()->create([
                'name' => $menuData['name'],
                'price' => $menuData['price'],
            ]);

            if (isset($menuData['toppings'])) {
                foreach ($menuData['toppings'] as $toppingData) {
                    // トッピングデータの取得と保存
                    $topping = Topping::firstOrCreate([
                        'name' => $toppingData['name'],
                        'price' => $toppingData['price']
                    ]);
                    $menu->toppings()->attach($topping->id);
                }
            }
        }

        return redirect()->route('shops.confirm');
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
