@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Menu</h1>
        @foreach ($noticeMenus as $noticeMenu)
            <div class="menu-item" data-notice-menu-id="{{ $noticeMenu->id }}" style="cursor: pointer;">
                <div class="menu-image">
                    <!-- Image insertion point -->
                </div>
                <div class="menu-info">
                    <h3>{{ $noticeMenu->menu->name }}</h3>
                    <p><strong>{{ number_format($noticeMenu->menu->price - $noticeMenu->discount) }} 円</strong> @if($noticeMenu->discount > 0)
                        （定価：{{ number_format($noticeMenu->menu->price) }} 円）@endif</p>
                </div>
            </div>
        @endforeach
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
