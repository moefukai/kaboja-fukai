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
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
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
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
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
        ul {
            list-style-type: disc;
            padding-left: 20px;
        }
    </style>
    <div class="container">
        <div class="container-texts">
            <h1>注文確認</h1>
            <div class="mt-3 sm:mt-4">
                <div class="tabs-container">
                    <nav class="tabs-nav">
                        <a href="{{ route('check.order.show') }}" class="{{ request()->routeIs('check.order.show') ? 'tab-active' : 'tab' }}">確認待ち</a>
                        <a href="{{ route('to.serve.show') }}" class="{{ request()->routeIs('to.serve.show') ? 'tab-active' : 'tab' }}">受け渡し待ち</a>
                        <a href="{{ route('history.show') }}" class="{{ request()->routeIs('history.show') ? 'tab-active' : 'tab' }}">注文履歴一覧</a>
                    </nav>
                </div>
            </div>
            <div class="info">
                @forelse ($orders as $order)
                    <div class="order-detail">
                        <p>予約番号: {{ $order->id }}</p>
                        @foreach ($order->orderMenus as $orderMenu)
                            <p>【メニュー名】{{ $orderMenu->noticeMenu->menu->name ?? 'メニュー名不明' }}</p>
                            <p>【オプション】</p>
                            @if($orderMenu->orderOptions->isEmpty())
                                <p>オプションなし</p>
                            @else
                                <ul>
                                    @foreach ($orderMenu->orderOptions as $orderOption)
                                        <li>{{ $orderOption->option->name ?? 'オプション情報不明' }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        @endforeach
                        <p>【合計金額】{{ number_format($order->total_price) }}円</p>
                        <p>【来店時間】{{ \Carbon\Carbon::parse($order->visiting_time)->format('m月d日H時i分') }}</p>
                        <p>【お客様の電話番号】{{ $order->tell }}</p>
                        <p>【備考】{{ $order->note }}</p>
                    </div>
                    <div class="register">
                        <form action="{{ route('order.updateStatus', $order->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">受け渡し済みにする</button>
                        </form>
                    </div>
                @empty
                    <p>表示する注文がありません。</p>
                @endforelse
                <div class="container mx-auto px-4">
                    {{ $orders->links('components.custom-pagenation') }}
                </div>
            </div>
        </div>
    </div>
@endsection
