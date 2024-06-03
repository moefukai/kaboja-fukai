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
            padding-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f8f8f8;
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
        <h1>注文履歴</h1>
        <table class="table">
            <thead>
            <tr>
                <th>オーダーID</th>
                <th>電話番号</th>
                <th>来店予定時刻</th>
                <th>備考</th>
                <th>合計金額</th>
                <th>確認ステータス</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->tell }}</td>
                    <td>{{ $order->visiting_time }}</td>
                    <td>{{ $order->note }}</td>
                    <td>{{ number_format($order->total_price, 2) }}円</td>
                    <td>{{ $order->status == 3 ? '完了' : 'その他' }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $orders->links() }}
    </div>
@endsection
