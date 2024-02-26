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

        .tab {
            display: inline-block;
            padding: 8px 16px;
            border-bottom: 2px solid transparent;
            text-decoration: none;
            color: #6B7280;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .tab-active, .tab:hover {
            color: #F6AE2C;
            border-bottom-color: #F6AE2C;
        }

        .tabs-container {
            border-bottom: 2px solid #E5E7EB;
        }

        .tabs-nav {
            display: flex;
            gap: 16px;
            padding-bottom: 4px;
        }
    </style>
    <div class="container">
        <h1>注文確認</h1>
        <div class="order-summary">
            <p>メニュー名: {{ $noticeMenu->menu->name }}</p>
            <p>価格: {{ number_format($discountedPrice) }}円</p>
            <p>選択したオプション：</p>
            <ul>
                @foreach($selectedOptions as $option)
                    <li>{{ $option->name }}: {{ number_format($option->price) }}円</li>
                @endforeach
            </ul>
            <p>合計金額: {{ number_format($totalPrice) }}円</p>
            <p>来店時間: {{ \Carbon\Carbon::parse($visitingTime)->format('m月d日H時i分') }}</p>
            <p>お客様の電話番号: {{ $tell }}</p>
            <p>備考: {{ $note }}</p>
        </div>
        <form action="{{ route('order.final', ['orderId' => $order->id]) }}" method="post">
            @csrf
            <div class="register">
            <button type="submit">予約番号を取得する</button>
            </div>
        </form>
    </div>
@endsection
