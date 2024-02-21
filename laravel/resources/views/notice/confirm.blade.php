@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>確認画面</h1>
        <div>
            <label>店名: {{ $shop->name }}</label>
        </div>
        <div>
            <label>出店場所: {{ $notice->address }}</label>
        </div>
        @foreach($noticeMenus as $noticeMenu)
            <div>
                <label>メニュー: {{ $noticeMenu->menu->name }}</label>
{{--                <ul>--}}
{{--                    @foreach($noticeMenu->menu->toppings as $id => $name)--}}
{{--                        <li>{{ $name }}</li>--}}
{{--                    @endforeach--}}
{{--                </ul>--}}
            </div>
            <div>
                <label>値段: ¥{{ number_format($noticeMenu->menu->price) }}</label>
            </div>
            <div>
                <label>値引き: ¥{{ number_format($noticeMenu->discount) }}</label>
            </div>
        @endforeach
        <div>
            <label>販売開始時間: {{ $start_time }}</label>
        </div>
        <div>
            <label>販売終了時間: {{ $end_time }}</label>
        </div>
{{--        <div>--}}
{{--            <label>支払い方法: {{ $shop->payment }}</label>--}}
{{--        </div>--}}
        <!-- ここに投稿するボタンのコードを配置 -->
        <form action="{{ route('post.tweet') }}" method="post">
            @csrf
            <input type="hidden" name="shop_name" value="{{ $shop->name }}">
            <input type="hidden" name="address" value="{{ $notice->address }}">
            <div id="menuItemsContainer"></div>
            <input type="hidden" name="start_time" value="{{ $start_time }}">
            <input type="hidden" name="end_time" value="{{ $end_time }}">
            <button type="submit" class="btn btn-primary">Twitterに投稿する</button>
        </form>
    </div>
    <script id="menuItemsData" type="application/json">@json($noticeMenus)</script>
    <script src="{{ asset('js/menuItems.js') }}"></script>
@endsection

