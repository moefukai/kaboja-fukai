<?php

namespace App\Http\Controllers;

use Abraham\TwitterOAuth\TwitterOAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class TwitterTestController extends Controller
{
    public function postTweet(Request $request)
    {
        $menus = $request->input('menus', []);
        $tweetText = "【通知】" . $request->input('shop_name') . "\n" .
            "出店場所: " . $request->input('address') . "\n";

        foreach ($menus as $menu) {
            $tweetText .= "メニュー: " . $menu['name'] . "\n" .
                "価格: ¥" . number_format($menu['price'] - $menu['discount']) . "\n";
        }
        $tweetText .= "販売時間:" . $request->input('start_time') . " - " . $request->input('end_time');
        $tweetText .= "\n注文はこちらから！" . "http://127.0.0.1:48080/order/main/1" . $request->input('shop_id');
        $tweetText .= "\n#西新宿 #ランチ難民 #キッチンカー";

        $twitter = new TwitterOAuth(
            env('TWITTER_API_KEY'),
            env('TWITTER_API_SECRET'),
            env('TWITTER_ACCESS_TOKEN'),
            env('TWITTER_ACCESS_TOKEN_SECRET')
        );

        $twitter->setApiVersion('2');
        $response = $twitter->post('tweets', ['text' => $tweetText], true);

        $httpCode = $twitter->getLastHttpCode();
        if ($httpCode != 200 && $httpCode != 201) {
            Log::error('Tweet failed to post.', ['http_code' => $httpCode, 'response' => $response]);
            return back()->with('error', 'Failed to post tweet.');
        }
        return redirect()->route('notice.final');
    }
    public function final()
    {
        return view('notice.final');
    }
}
