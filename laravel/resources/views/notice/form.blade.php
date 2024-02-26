@extends('layouts.app')

@section('content')
    <style>
        .address-info {
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

        .time-info {
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
            border-color: #F6AE2C;
        }

        .select-focused-custom:focus {
            outline: none;
            border-color: #F6AE2C;
            box-shadow: 0 0 0 2px #F6AE2C;
        }

    </style>
    <div class="container">
    <div class="container-texts">
        <h1>投稿作成</h1>
        <form action="{{ route('notice.store') }}" method="post">
            @csrf
            <input type="hidden" name="shop_id" value="{{ $shop->id }}">
            <div class="address-info">
            <div class="form-group">
                <label for="address">出店場所</label>
                <div class="relative mt-2">
                    <input type="text" id="address" name="address" required class="peer block w-full border-0 bg-gray-50 py-1.5 text-gray-900 focus:ring-0 sm:text-sm sm:leading-6" placeholder="出店場所の住所を記入してください">
                    <div class="absolute inset-x-0 bottom-0 border-t border-gray-300 peer-focus:border-t-2 peer-focused-custom" aria-hidden="true"></div>
                </div>
            </div>
            </div>
            <div class="menu-info">
            <div id="menus-container">
                <label>メニュー</label>
            </div>
            <button type="button" id="add-menu-btn">メニューを追加</button>
            </div>
            <div class="time-info">
            <div class="form-group">
                <label for="start_time">販売開始時間</label>
                <select class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 select-focused-custom sm:text-sm sm:leading-6" id="start_time" name="start_time" required>
                    @for ($i = 11; $i < 15; $i++)
                        <option value="{{ sprintf('%02d:00', $i) }}">{{ sprintf('%02d:00', $i) }}</option>
                        <option value="{{ sprintf('%02d:30', $i) }}">{{ sprintf('%02d:30', $i) }}</option>
                    @endfor
                </select>
            </div>
            <div class="form-group">
                <label for="end_time">販売終了時間</label>
                <select class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 select-focused-custom sm:text-sm sm:leading-6" id="end_time" name="end_time" required>
                    @for ($i = 11; $i < 15; $i++)
                        <option value="{{ sprintf('%02d:00', $i) }}">{{ sprintf('%02d:00', $i) }}</option>
                        <option value="{{ sprintf('%02d:30', $i) }}">{{ sprintf('%02d:30', $i) }}</option>
                    @endfor
                </select>
            </div>
            </div>
            <div class="register">
            <button type="submit" class="btn btn-primary" id="submit-form">登録する</button>
            </div>
        </form>
    </div>
    </div>
    @push('scripts')
        <script src="{{ mix('js/notice-handler.js') }}"></script>
    @endpush
@endsection
