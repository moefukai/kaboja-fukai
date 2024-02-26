@extends('layouts.app')

@section('content')
    <style>
        .info {
            background-color: #FFF;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            margin-top: 20px;
        }

        .container {
            padding: 20px;
        }

        .container-texts {
            margin-top: 20px;
        }

        h1 {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        button {
            border: solid 1px #5C9757;
            border-radius: 3px;
            color: #5C9757;
            cursor: pointer;
            padding: 3px 5px;
            text-align: center;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .register {
            display: flex;
            justify-content: center;
        }

        .register button {
            fill: #5C9757;
            min-width: 100px;
            height: 40px;
            border: solid 1px #5C9757;
            border-radius: 5px;
            background-color: #5C9757;
            color: #fff;
            cursor: pointer;
            margin-top: 20px;
            white-space: nowrap; /* テキストが折り返されないように設定 */
            overflow: hidden; /* はみ出した内容を非表示に */
            text-overflow: ellipsis; /* はみ出したテキストを省略記号で表示 */
        }

        .peer:focus + .peer-focused-custom {
            border-color: #F6AE2C;
        }

        .select-focused-custom:focus {
            outline: none;
            border-color: #F6AE2C;
            box-shadow: 0 0 0 2px #F6AE2C;
        }
    </style>
    <div class="container">
        <div class="container-texts">
        <h1>確認画面</h1>
        <div class="info">
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
            @foreach($payment as $pay)
                <div>
                    <label>支払い方法: {{ $pay->payment }}</label>
                </div>
            @endforeach
        </div>
        <!-- ここに投稿するボタンのコードを配置 -->
        <div class="register">
            <form action="{{ route('post.tweet') }}" method="post">
                @csrf
                <input type="hidden" name="shop_name" value="{{ $shop->name }}">
                <input type="hidden" name="address" value="{{ $notice->address }}">
                <div id="menuItemsContainer"></div>
                <input type="hidden" name="start_time" value="{{ $start_time }}">
                <input type="hidden" name="end_time" value="{{ $end_time }}">
                <button type="submit" class="btn btn-primary">Xに投稿</button>
            </form>
        </div>
    </div>
    </div>
    <script id="menuItemsData" type="application/json">@json($noticeMenus)</script>
    <script src="{{ asset('js/menuItems.js') }}"></script>
@endsection

