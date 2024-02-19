@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>注文詳細</h1>
        <form action="{{ route('order.store') }}" method="POST">
            @csrf
            <h1>注文詳細</h1>
            <div>
                <p>メニュー名: {{ $noticeMenu->menu->name }}</p>
                <p>基本価格: ¥{{ number_format($noticeMenu->menu->price) }}</p>
                <p>値引き: ¥{{ number_format($noticeMenu->discount) }}</p>
                <p>値引き後の価格: ¥{{ number_format($discountedPrice) }}</p>
            </div>

            <div class="form-group">
                <label for="total_number">個数選択:</label>
                <select name="total_number" id="total_number" class="form-control" onchange="updateTotalPrice()">
                    @for ($i = 1; $i <= 10; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>

            <div class="form-group">
                <label for="topping">トッピング選択:</label>
                <select name="topping" id="topping" class="form-control">
                    @foreach ($toppings as $topping)
                        <option value="{{ $topping->id }}" data-price="{{ $topping->price }}">{{ $topping->name }} (+¥{{ number_format($topping->price) }})</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="visiting">来店時間:</label>
                <select name="visiting" id="visiting" class="form-control">
                    @for ($time = 660; $time <= 900; $time += 15)
                        <option value="{{ \Carbon\Carbon::createFromTime(0)->addMinutes($time)->format('H:i') }}">
                            {{ \Carbon\Carbon::createFromTime(0)->addMinutes($time)->format('H:i') }}
                        </option>
                    @endfor
                </select>
            </div>

            <div class="form-group">
                <label for="tell">お客様の電話番号:</label>
                <input type="text" name="tell" id="tell" class="form-control">
            </div>

            <div class="form-group">
                <label for="note">備考:</label>
                <textarea name="note" id="note" class="form-control"></textarea>
            </div>

            <div class="form-group">
                <p>合計金額: ¥<span id="totalPrice"></span></p>
            </div>

            <button type="submit" class="btn btn-primary">注文を確定</button>
        </form>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('js/order.handler.js') }}"></script>
@endsection
