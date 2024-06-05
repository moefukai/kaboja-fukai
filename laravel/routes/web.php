<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\TwitterTestController;
use App\Http\Controllers\Auth\RegisterController;

// welcome
Route::get('/', function () {
    return view('welcome');
});

if (env("APP_DEBUG")) {
    Route::get('/test', function () {
        return view('test');
    })->name('local-test');
}

// Auth routes
require __DIR__ . '/auth.php';

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/order/main/{shop_id}', [OrderController::class, 'create'])->name('order.main');
Route::get('/order/detail/{noticeMenuId}', [OrderController::class, 'showDetail'])->name('order.detail.show');
Route::post('/order/detail/store', [OrderController::class, 'storeDetail'])->name('order.detail.store');
Route::get('/order/confirm/{orderId}', [OrderController::class, 'confirm'])->name('order.confirm');
Route::get('/order/final/{orderId}', [OrderController::class, 'final'])->name('order.final');
Route::post('/order/final/{orderId}', [OrderController::class, 'final'])->name('order.final-post');

// 以下のルートはログインユーザーのみアクセス可能
//Route::middleware(['auth'])->group(function () {
////    Route::get('/dashboard', function () {
////        return view('dashboard');
////    })->name('dashboard');

Route::middleware(['auth.user'])->group(function () {

    // Notice
    Route::get('/notice', [NoticeController::class, 'create'])->name('notice.create');
    Route::post('/notice', [NoticeController::class, 'store'])->name('notice.store');
    Route::get('/notice/confirm/{id}', [NoticeController::class, 'show'])->name('notice.confirm');
    Route::get('/notice/final', [TwitterTestController::class, 'final'])->name('notice.final');
    Route::post('/notice/final', [TwitterTestController::class, 'final'])->name('notice.final-post');

    // Shop
    Route::get('/shop', [ShopController::class, 'create'])->name('shops.create');
    Route::post('/shop', [ShopController::class, 'store'])->name('shops.store');
    Route::get('/shop/confirm', [ShopController::class, 'confirm'])->name('shops.confirm');

    // Menu
    Route::get('/menus', [MenuController::class, 'index']);
    Route::get('/menus/{menu}/toppings', [MenuController::class, 'toppings']);

    //オーダー確認
    Route::get('/check-order', [OrderController::class, 'checkOrder'])->name('check.order.show');
    Route::post('/order/update-status/{order}', [OrderController::class, 'updateStatus'])->name('order.updateStatus');
//    Route::get('/check-order/to-check', [OrderController::class, 'showToCheck'])->name('to.check.show');
    Route::get('/check-order/to-serve', [OrderController::class, 'showToServe'])->name('to.serve.show');
//    Route::get('/check-order/history', [OrderController::class, 'showToHistory'])->name('history.show');

    //// Twitterに投稿するルート
    //Route::post('/post-tweet', [TwitterController::class, 'postTweet'])->name('post.tweet');
    // テスト投稿フォームを表示するためのルート
    Route::get('/twitter-test', function () {
        return view('twitter.twitter-test');
    });
    Route::post('/tweet', [TwitterTestController::class, 'postTweet']);
    Route::post('/post-tweet', [TwitterTestController::class, 'postTweet'])->name('post.tweet');
});

    //セッション管理
    Route::post('/save-notice-menu-id', [OrderController::class, 'saveNoticeMenuId']);

    // Auth routes
    require __DIR__ . '/auth.php';
