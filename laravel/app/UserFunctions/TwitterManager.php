<?php

namespace App\UserFunctions;

use Abraham\TwitterOAuth\TwitterOAuth;
use Illuminate\Support\Facades\Log;

class TwitterManager
{
    public function tweet()
    {
        $twitter = new TwitterOAuth(
            config('services.twitter.api_key'),
            config('services.twitter.api_secret'),
            config('services.twitter.access_token'),
            config('services.twitter.access_token_secret'),
            config('bearer_token')
        );

        $message = "テスト投稿";

//        $response = $twitter->post("statuses/update", ["status" => $message]);
        $response = $twitter->post(
            "https://api.twitter.com/2/tweets", // ツイート投稿用のエンドポイントURL
            ["status" => $message]
        );
        Log::info('API Response', (array)$response);
        Log::info('Twitter HTTP status code', ['http_code' => $twitter->getLastHttpCode()]);
        Log::error('Twitter API response', ['response' => $twitter->getLastBody()]);

        if ($response && isset($response->id)) {
            Log::info('Twitter post succeeded', ['tweet_id' => $response->id]);
        } else {
            Log::error('Twitter post failed', ['errors' => $response->errors ?? 'Unknown error']);
        }
    }
}
