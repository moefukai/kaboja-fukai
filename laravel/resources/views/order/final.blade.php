@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>予約票</h1>
        <div>この画面はスクリーンショットで必ず保存してください</div>
        <div class="order-summary">
            <p>予約番号: {{ $orderId }}</p>
            <p>キッチンカー名: {{ $shopName }}</p>
            <p>出店場所: {{ $address }}</p>
        </div>
    </div>
@endsection

