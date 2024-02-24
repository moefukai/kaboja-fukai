@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route('order.detail.store') }}" method="POST">
            @csrf
            <h1>注文詳細</h1>
            <div class="order-menu-item">
                <p>メニュー名: {{ $noticeMenu->menu->name }}</p>
                <p id="discountedPrice" data-discounted-price="{{ number_format($discountedPrice, 2, '.', '') }}">価格: {{ number_format($discountedPrice) }}円</p>
            </div>

            <div id="optionContainer"></div>
            <!-- ここでオプションのチェックボックスを動的に生成します -->

            <div class="form-group">
                <p>合計金額: <span id="totalPrice"></span>円</p>
                <!-- 合計金額をサーバーに送信するための隠しフィールド -->
                <input type="hidden" id="total_price" name="total_price" value="">
            </div>
            <h1>来店者情報</h1>
            <div class="form-group">
                <label for="visiting_time">来店時間:</label>
                <select name="visiting_time" id="visiting_time" class="form-control">
                    @for ($hour = 11; $hour <= 15; $hour++)
                        @foreach (['00', '15', '30', '45'] as $minute)
                            @if (!($hour == 15 && $minute != '00')) {{-- 15:00を超える時間は除外 --}}
                            <option value="{{ sprintf('%02d:%s', $hour, $minute) }}">{{ sprintf('%02d:%s', $hour, $minute) }}</option>
                            @endif
                        @endforeach
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
            <input type="hidden" name="shop_id" value="{{ $shopId }}">
            <input type="hidden" name="notice_menu_id" value="{{ $noticeMenu->id }}">
            <button type="submit" name="action" value="confirm_order" class="btn btn-secondary">確定</button>
        </form>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/order-handler.js') }}"></script>
    <script>
        const options = @json($options);
    </script>
@endpush

<style>
    .order-menu-item {
        margin-bottom: 20px;
        border-start-end-radius: 1px;
    }
    .option-group {
        margin-bottom: 20px;
    }
    .option-label {
        margin-bottom: 10px;
    }
    .checkboxes {
        display: flex;
        flex-wrap: wrap;
    }
    .checkboxes label {
        margin-right: 20px;
    }
</style>
