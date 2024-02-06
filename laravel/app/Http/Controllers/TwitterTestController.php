<?php

namespace App\Http\Controllers;

use Abraham\TwitterOAuth\TwitterOAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TwitterTestController extends Controller
{
    public function postTweet(Request $request)
    {

        $twitter = new TwitterOAuth(
            env('TWITTER_API_KEY'),
            env('TWITTER_API_SECRET'),
            env('TWITTER_ACCESS_TOKEN'),
            env('TWITTER_ACCESS_TOKEN_SECRET')
        );

        $twitter->setApiVersion('2');
        $response = $twitter->post('tweets', ['text' => '本日のテスト'], true);

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
}
