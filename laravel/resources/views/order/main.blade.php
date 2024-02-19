@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>メニュー一覧</h1>
        @foreach ($noticeMenus as $noticeMenu)
            <div class="menu-item" onclick="location.href='{{ route('order.detail.show', ['noticeMenuId' => $noticeMenu->id]) }}'" style="cursor: pointer;">
            <div class="menu-image">
                    <!-- ここに将来的に画像を挿入 -->
                </div>
                <div class="menu-info">
                    <h3>{{ $noticeMenu->menu->name }}</h3>
                    <p>定価: ¥{{ number_format($noticeMenu->menu->price) }}</p>
                    @if($noticeMenu->discount > 0)
                        <p><strong>値引き後: ¥{{ number_format($noticeMenu->menu->price - $noticeMenu->discount) }}</strong></p>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@endsection

@section('scripts')
    <script>
        // 必要に応じてJavaScriptをここに追加
    </script>
@endsection

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
