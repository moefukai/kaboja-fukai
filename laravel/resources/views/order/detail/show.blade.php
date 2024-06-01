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
    white-space: nowrap; /* テキストが折り返されないように設定 */
    overflow: hidden; /* はみ出した内容を非表示に */
    text-overflow: ellipsis; /* はみ出したテキストを省略記号で表示 */
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
    border-color: #5C9757;
    }

    .select-focused-custom:focus {
    outline: none;
    border-color: #5C9757;
    box-shadow: 0 0 0 2px #5C9757;
    }

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
    .custom-checkbox-container {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }

    .custom-checkbox {
        position: relative;
        height: 20px;
        width: 20px;
        border: 2px solid #d1d5db;
        border-radius: 4px;
        background-color: #ffffff;
        cursor: pointer;
        margin-right: 8px;
        transition: background-color 0.2s, border-color 0.2s;
    }

    .custom-checkbox.checked {
        background-color: #5C9757;
        border-color: #5C9757;
    }

    .custom-checkbox::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) rotate(45deg);
        width: 6px;
        height: 12px;
        border: solid #ffffff;
        border-width: 0 2px 2px 0;
        display: none;
    }

    .custom-checkbox.checked::after {
        display: block;
    }

    .custom-checkbox-input {
        display: none;
    }

    .custom-checkbox-label {
        display: inline-flex;
        align-items: center;
        cursor: pointer;
    }


    </style>
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
            <div class="form-group relative mt-2">
                <label for="tell">お客様の電話番号:</label>
                <input type="text" id="tell" name="tell" required class="peer block w-full border-0 bg-gray-50 py-1.5 text-gray-900 focus:ring-0 sm:text-sm sm:leading-6" placeholder="電話番号を記入してください">
                <div class="absolute inset-x-0 bottom-0 border-t border-gray-300 peer-focus:border-t-2 peer-focused-custom" aria-hidden="true"></div>
            </div>
            <div class="form-group">
                <label for="note">備考:</label>
                <textarea name="note" id="note" class="form-control"></textarea>
            </div>
            <input type="hidden" name="shop_id" value="{{ $shopId }}">
            <input type="hidden" name="notice_menu_id" value="{{ $noticeMenu->id }}">
            <div class="register">
            <button type="submit" name="action" value="confirm_order" class="btn btn-secondary">確定</button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/order-handler.js') }}"></script>
    <script>
        const options = @json($options);
    </script>
@endpush
