<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Menu;
use App\Models\Topping;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ShopController extends Controller
{
    public function create()
    {
        session(['showNavigation' => true]);
        $menus = Menu::all();
        return view('shop.form', compact('menus'));
    }
    public function store(Request $request)
    {
        $shop = Shop::create([
            'name' => $request->name,
            'contact' => $request->contact,
            'user_id' => Auth::id(),
        ]);

        foreach ($request->menus as $menuData) {
            $menuName = isset($menuData['name']) ? $menuData['name'] : null;
            $menuPrice = isset($menuData['price']) ? $menuData['price'] : null;
            $menu = $shop->menus()->create([
                'name' => $menuName,
                'price' => $menuPrice,
            ]);

            if (isset($menuData['toppings'])) {
                foreach ($menuData['toppings'] as $toppingData) {
                    $toppingName = isset($toppingData['name']) ? $toppingData['name'] : null;
                    $toppingPrice = isset($toppingData['price']) ? $toppingData['price'] : null;
                    $topping = Topping::firstOrCreate([
                        'name' => $toppingName,
                        'price' => $toppingPrice,
                    ]);
                    $menu->toppings()->attach($topping->id);
                }
            }
        }
        if (!empty($request->paymentMethods)) {
            foreach ($request->paymentMethods as $paymentMethod) {
                if (!empty($paymentMethod)) {
                    Payment::create([
                        'shop_id' => $shop->id,
                        'payment' => $paymentMethod,
                    ]);
                }
            }
        }
        if (!empty($request->options)) {
            foreach ($request->options as $optionData) {
                $optionName = $optionData['name'] ?? null;
                $optionPrice = $optionData['price'] ?? null;
                if (!empty($optionName) && !is_null($optionPrice)) {
                    $shop->options()->create([
                        'name' => $optionName,
                        'price' => $optionPrice,
                    ]);
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
