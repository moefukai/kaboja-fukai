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
            white-space: nowrap; /* テキストが折り返されないように設定 */
            overflow: hidden; /* はみ出した内容を非表示に */
            text-overflow: ellipsis; /* はみ出したテキストを省略記号で表示 */
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

        .menu-item {
            width: calc(50% - 10px);
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
            display: inline-block;
            vertical-align: top;
            margin-right: 20px;
        }

        .menu-item:nth-child(2n) {
            margin-right: 0;
        }

        .menu-image {
            height: 200px;
            background-color: #f3f3f3;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #666;
            font-size: 20px;
        }

        .menu-info {
            padding: 10px 15px;
        }

        .menu-info h3 {
            margin-top: 0;
        }
    </style>
    <div class="container">
        <h1>Menu</h1>
        <div style="text-align: center;"> <!-- コンテナを中央揃えに -->
            @foreach ($noticeMenus as $noticeMenu)
                <div class="menu-item" data-notice-menu-id="{{ $noticeMenu->id }}">
                    <div class="menu-image">
                        (画像)
                    </div>
                    <div class="menu-info">
                        <h3>{{ $noticeMenu->menu->name }}</h3>
                        <p><strong>{{ number_format($noticeMenu->menu->price - $noticeMenu->discount) }} 円</strong> @if($noticeMenu->discount > 0)
                                （定価：{{ number_format($noticeMenu->menu->price) }} 円）@endif</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('js/orderMain.js') }}"></script>
@endpush

@section('styles')
{{--    <style>--}}
{{--        .menu-item {--}}
{{--            border: 1px solid #ddd;--}}
{{--            margin-bottom: 20px;--}}
{{--            padding: 10px;--}}
{{--        }--}}
{{--        .menu-image {--}}
{{--            float: left;--}}
{{--            width: 120px;--}}
{{--            height: 120px;--}}
{{--            background-color: #f0f0f0;--}}
{{--            margin-right: 20px;--}}
{{--        }--}}
{{--        .menu-info {--}}
{{--            overflow: hidden;--}}
{{--        }--}}
{{--    </style>--}}
@endsection
