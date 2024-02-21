@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route('order.detail.store') }}" method="POST">
            @csrf
            <h1>注文詳細</h1>
            <div>
                <p>メニュー名: {{ $noticeMenu->menu->name }}</p>
                <p>基本価格: {{ number_format($noticeMenu->menu->price) }}円</p>
                <p>値引き: {{ number_format($noticeMenu->discount) }}円</p>
                <p id="discountedPrice">値引き後の価格: {{ number_format($discountedPrice) }}円</p>
            </div>

            <div class="form-group">
                <label for="total_number">個数選択:</label>
                <select name="total_number" id="total_number" class="form-control">
                    @for ($i = 1; $i <= 10; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <div id="optionContainer"></div>
            <template id="optionTemplate">
                <div class="form-group option-group">
                    <label class="option-label">オプション選択:</label>
                    <div class="checkboxes">
                    </div>
                </div>
            </template>
            <div class="form-group">
                <p>合計金額: <span id="totalPrice"></span>円</p>
            </div>
            <input type="hidden" name="shop_id" value="{{ $shopId }}">
            <button type="submit" name="action" value="add_more" class="btn btn-primary">追加注文をする</button>
            <button type="submit" name="action" value="confirm_order" class="btn btn-primary">注文を確定</button>
        </form>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('js/order-handler.js') }}"></script>
    <script>
        const options = @json($options);
    </script>
@endpush
