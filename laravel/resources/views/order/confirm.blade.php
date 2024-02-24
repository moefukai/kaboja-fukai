@extends('layouts.app')

@section('content')
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
            <button type="submit">予約番号を取得する</button>
        </form>
    </div>
@endsection
