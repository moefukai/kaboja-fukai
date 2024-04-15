<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <title>テストページ</title>
    <style>
        img {
            width: 100vw;
            height: 100vh;
            object-fit: cover;
            position: absolute;
            top: 0;
            left: 0;
        }
    </style>
</head>
<body>
<div class="container pt-4">
    テストページです。<br>
    <hr>
    経営者ページリンク一覧<br>
    <a href="/home">店舗経営者ページトップ</a><br>
    <a href="/register">店舗情報登録ページ</a><br>
    <a href="/notice">お知らせ作成ページ</a><br>
    <a href="/shop">店舗作成ページ</a><br>
    <a href="/menus">店舗メニューページ</a><br>
    <a href="/check-order">店舗オーダー確認ページ</a><br>
    <a href="/twitter-test">X(twitter)投稿フォームページ</a>
    <hr>
    利用者ページリンク一覧<br>
    <a href="/order/main/1">店舗ID=1の注文ページ</a>
</div>
</body>
</html>
