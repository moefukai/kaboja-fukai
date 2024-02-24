@extends('layouts.app')

@section('content')
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <h1>投稿完了</h1>
        <p>正常に投稿が完了しました。</p>
        {{--        <div>--}}
        {{--            <a href="{{ route('shops.edit', ['shop' => $shop->id]) }}" class="btn btn-primary">編集する</a>--}}
        {{--        </div>--}}
    </div>
@endsection
