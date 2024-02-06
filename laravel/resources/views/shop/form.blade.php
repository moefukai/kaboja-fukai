@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>店舗情報登録フォーム</h1>
        <form action="{{ route('shops.store') }}" method="post">
            @csrf
            <div>
                <label for="name">店名:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div>
                <label for="contact">連絡先:</label>
                <input type="text" id="contact" name="contact" required>
            </div>
            <div>
                <label for="shop-image">店舗イメージ:</label>
                <input type="text" id="shop-image" name="shop-image">
            </div>
            <div>
                <button type="submit">登録する</button>
            </div>
        </form>
    </div>
@endsection
