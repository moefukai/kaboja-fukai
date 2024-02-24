<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Topping;
use App\Models\User;

class MenuController extends Controller
{
    public function store(Request $request)
    {
        $shop = auth()->user()->shop;

        foreach ($request->menus as $menuData) {
            $menu = Menu::create([
                'name' => $menuData['name'],
                'price' => $menuData['price'],
                'shop_id' => $shop->id,
            ]);
//            if (isset($menuData['toppings'])) {
//                foreach ($menuData['toppings'] as $toppingData) {
//                    $topping = Topping::firstOrCreate([
//                        'name' => $toppingData['name'],
//                        'price' => $toppingData['price'],
//                    ]);
//                    $menu->toppings()->attach($topping->id);
//                }
//            }
            return redirect()->route('shops.confirm');
        }
    }

    public function index()
    {
        $menus = Menu::all();
        return response()->json($menus);
    }
    public function toppings(Menu $menu)
    {
        $toppings = $menu->toppings;
        return response()->json($toppings);
    }

//    public function toppings($menuId)
//    {
//        $toppings = Topping::whereHas('menus', function ($query) use ($menuId) {
//            $query->where('menus.id', $menuId);
//        })->get();
//
//        return response()->json($toppings);
//    }
}
