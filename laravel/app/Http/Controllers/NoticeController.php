<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Notice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoticeController extends Controller
{
    public function create()
    {
        // notice.createは通知作成フォームのビューファイル名に合わせて調整してください
        return view('notice.form');
    }
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'address' => 'required|max:255',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
        ]);

        // 現在ログインしているユーザーに紐づいた店舗を検索
        $shop = Shop::where('user_id', Auth::id())->firstOrFail();

        if (!$shop) {
            return back()->withErrors(['error' => 'このユーザーに対応する店舗が見つかりません。']);
        }

        $notice = new Notice($validatedData);
        $notice->shop_id = $shop->id;
        $notice->save();

        return redirect()->route('notice.confirm');
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
