<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\TwitterController;
use App\Http\Controllers\TwitterTestController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//welcome
Route::get('/', function () {
    return view('welcome');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});

// Notice
Route::get('/notice', [NoticeController::class, 'create'])->name('notice.create');
Route::post('/notice', [NoticeController::class, 'store'])->name('notice.store');
Route::get('/notice/confirm', [NoticeController::class, 'show'])->name('notice.confirm');
Route::get('/notice/edit/{id}', [NoticeController::class, 'edit'])->name('notice.edit');

// Shop
Route::get('/shop', [ShopController::class, 'create'])->name('shops.create');
Route::post('/shop', [ShopController::class, 'store'])->name('shops.store');
Route::post('/shops/store', [ShopController::class, 'store'])->name('shops.store');
Route::get('/shop/confirm', [ShopController::class, 'confirm'])->name('shops.confirm');
//Route::get('/shop/edit/{shop}', [ShopController::class, 'edit'])->name('shops.edit');
//Route::get('/shop/confirm/{shop}', [ShopController::class, 'confirm'])->name('shops.confirm');
//Route::post('/shop/update/{shop}', [ShopController::class, 'update'])->name('shops.update');

// Menu
Route::get('/menus', [MenuController::class, 'index']);
Route::get('/menus/{menu}/toppings', [MenuController::class, 'toppings']);

// Twitterに投稿するルート
Route::post('/post-tweet', [TwitterController::class, 'postTweet'])->name('post.tweet');

// テスト投稿フォームを表示するためのルート
Route::get('/twitter-test', function () {
    return view('twitter.twitter-test');
});
Route::post('/tweet', [TwitterTestController::class, 'postTweet']);
//Route::post('/twitter/post-tweet', [TwitterTestController::class, 'postTweet'])->name('twitter.postTweet');

//Order
Route::get('/order/main/{shop_id}', [OrderController::class, 'create'])->name('order.main');
Route::get('/order/detail/{noticeMenuId}', [OrderController::class, 'show'])->name('order.detail.show');
Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');
Route::get('/order/confirm/{orderId}', [OrderController::class, 'confirm'])->name('order.confirm');
Route::get('/order/final/{orderId}', [OrderController::class, 'final'])->name('order.final');

// Auth routes
require __DIR__.'/auth.php';
