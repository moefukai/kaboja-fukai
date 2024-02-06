<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notice;

class NoticeConfirmationController extends Controller
{
    public function show($id)
    {
        // notices_tableから対象のデータを取得
        $notice = Notice::findOrFail($id);

        // 確認画面のビューを表示
        return view('notice.confirmation', compact('notice'));
    }
}

