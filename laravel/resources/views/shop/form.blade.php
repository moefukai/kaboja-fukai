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
            <div id="menu-container">
                <!-- JavaScriptでメニュー入力セクションを動的に追加 -->
            </div>
            <button type="button" id="add-menu">メニューを追加</button>
            <br>
            <button type="submit">登録する</button>
        </form>
    </div>
    @push('scripts')
        <script src="{{ mix('js/menu-handler.js') }}"></script>
    @endpush
@endsection

