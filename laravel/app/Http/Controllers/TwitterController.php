<?php

namespace App\Http\Controllers;

use Abraham\TwitterOAuth\TwitterOAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Notice;
use App\Models\Shop;

class TwitterController extends Controller
{
    public function postNoticeTweet(Request $request, $noticeId)
    {

        $notice = Notice::with('shop')->find($noticeId);

        if (!$notice) {
            Log::error('Notice not found', ['notice_id' => $noticeId]);
            return back()->with('error', '通知が見つかりません。');
        }

        $message = $this->formatMessage($notice);

        $twitter = new TwitterOAuth(
            env('TWITTER_API_KEY'),
            env('TWITTER_API_SECRET'),
            env('TWITTER_ACCESS_TOKEN'),
            env('TWITTER_ACCESS_TOKEN_SECRET')
        );

        $twitter->setApiVersion('2');
        $response = $twitter->post($message, true);

        $httpCode = $twitter->getLastHttpCode();
        $responseBody = json_decode(json_encode($response), true); // 応答を配列に変換

        if ($httpCode == 200) {
            // ツイート成功
            Log::info('Tweet posted successfully.', ['response' => $responseBody]);
        } else {
            // ツイート失敗
            Log::error('Tweet failed to post.', [
                'http_code' => $httpCode, // HTTPステータスコード
                'response' => $responseBody // 応答本体
            ]);

            // エラーメッセージがある場合はそれを特定する
            if (isset($responseBody['errors'])) {
                foreach ($responseBody['errors'] as $error) {
                    Log::error('Twitter API error', [
                        'code' => $error['code'], // エラーコード
                        'message' => $error['message'] // エラーメッセージ
                    ]);
                }
            }
        }
        return back()->with('status', 'Tweet posted successfully.');
    }

    private function formatMessage($notice)
    {
        $shop = $notice->shop;

        if (!$shop) {
            Log::error('Shop not found for notice', ['notice_id' => $notice->id]);
            return 'エラー: 店舗が見つかりません。';
        }
        return <<<EOT
【通知】{$shop->name}
メニュー: {$notice->menu}
価格: {$notice->price}円
住所: {$notice->address}
販売時間: {$notice->start_time} - {$notice->end_time}
EOT;
    }
}
