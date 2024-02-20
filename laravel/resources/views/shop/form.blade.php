@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>店舗情報登録</h1>
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
            <div id="paymentMethods">
                <div>
                    <label for="paymentMethod1">支払い方法:</label>
                    <input type="text" id="paymentMethod1" name="paymentMethods[]" required>
                </div>
            </div>
            <button type="button" id="addPaymentMethod">支払い方法を追加</button>
            <div id="menu-container">
                <!-- JavaScriptでメニュー入力セクションを動的に追加 -->
            </div>
            <button type="button" id="add-menu">メニューを追加</button>
            <br>
            <div id="option-container">
                <!-- JavaScriptでメニュー入力セクションを動的に追加 -->
            </div>
            <button type="button" id="add-option">オプションを追加</button>
            <br>
            <button type="submit">登録する</button>
        </form>
    </div>
    @push('scripts')
        <script src="{{ asset('js/payment.js') }}"></script>
        <script src="{{ mix('js/menu-handler.js') }}"></script>
        <script src="{{ asset('js/option.js') }}"></script>
    @endpush
@endsection

