@extends('layouts.app')

@section('content')

    <style>
        .base-info {
            background-color: #FFF;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .menu-info {
            background-color: #FFF;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            margin-top: 20px;
        }

        .container {
            background-color: #FDF7EE;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
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
            width: 100px;
            height: 40px;
            border: solid 1px #5C9757;
            border-radius: 5px;
            background-color: #5C9757;
            color: #fff;
            cursor: pointer;
            margin-top: 20px;
        }

        .peer:focus + .peer-focused-custom {
            border-color: #F6AE2C; /* カスタムカラーを適用 */
        }


    </style>

    <div class="container">
        <div class="container-texts">
        <h1>店舗情報登録</h1>
        <form action="{{ route('shops.store') }}" method="post">
            @csrf
            <div class="base-info">
                <h2>基本情報</h2>
            <div>
                <label for="name" class="block text-sm font-medium leading-6 text-gray-900">店名:</label>
                <div class="relative mt-2">
                    <input type="text" id="name" name="name" required class="peer block w-full border-0 bg-gray-50 py-1.5 text-gray-900 focus:ring-0 sm:text-sm sm:leading-6" placeholder="店名を入力">
                    <div class="absolute inset-x-0 bottom-0 border-t border-gray-300 peer-focus:border-t-2 peer-focus:border-indigo-600" aria-hidden="true"></div>
                </div>
            </div>
            <div>
                <label for="contact" class="block text-sm font-medium leading-6 text-gray-900">連絡先:</label>
                <div class="relative mt-2">
                    <input type="text" id="contact" name="contact" required class="peer block w-full border-0 bg-gray-50 py-1.5 text-gray-900 focus:ring-0 sm:text-sm sm:leading-6" placeholder="連絡先を入力">
                    <div class="absolute inset-x-0 bottom-0 border-t border-gray-300 peer-focus:border-t-2 peer-focus:border-indigo-600" aria-hidden="true"></div>
                </div>
            </div>
            <div id="paymentMethods">
                <div>
                    <label for="paymentMethod1" class="block text-sm font-medium leading-6 text-gray-900">支払い方法:</label>
                    <div class="relative mt-2">
                        <input type="text" id="paymentMethod1" name="paymentMethods[]" required class="peer block w-full border-0 bg-gray-50 py-1.5 text-gray-900 focus:ring-0 sm:text-sm sm:leading-6" placeholder="支払い方法を入力">
                        <div class="absolute inset-x-0 bottom-0 border-t border-gray-300 peer-focus:border-t-2 peer-focus:border-indigo-600" aria-hidden="true"></div>
                    </div>
                </div>
            </div>
            <button type="button" id="addPaymentMethod">追加</button>
            </div>

            <div class="menu-info">
                <h2>メニュー情報</h2>

                <div>メニュー:</div>
            <div id="menu-container">
                <!-- JavaScriptでメニュー入力セクションを動的に追加 -->
            </div>
            <button type="button" id="add-menu">追加</button>
            <br>
                <div>オプション:</div>
                <p>トッピングや量についてオプションがあれば入力してください</p>
            <div id="option-container">
                <!-- JavaScriptでメニュー入力セクションを動的に追加 -->
            </div>
            <button type="button" id="add-option">追加</button>
            <br>
            </div>
            <div class="register">
            <button type="submit">登録する</button>
            </div>
        </form>
        </div>
    </div>
    @push('scripts')
        <script src="{{ asset('js/payment.js') }}"></script>
        <script src="{{ mix('js/menu-handler.js') }}"></script>
        <script src="{{ asset('js/option.js') }}"></script>
    @endpush
@endsection

