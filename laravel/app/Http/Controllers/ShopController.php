<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function create()
    {
        return view('shop.form');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'contact' => 'required|max:255',
            'image' => 'nullable|max:255',
        ]);

        // 現在認証されているユーザーのIDを取得
        $userId = auth()->id();

        // createメソッドにuser_idを含めて保存
        Shop::create($validatedData + ['user_id' => $userId]);

        return redirect('/shop')->with('success', '店舗情報が登録されました。');
    }
}
