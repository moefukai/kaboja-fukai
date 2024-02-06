{{-- 確認画面ビュー --}}

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>確認画面</h1>
        <div>
            <label>出店場所: {{ $notice->address }}</label>
        </div>
        <div>
            <label>売れ残っているメニュー: {{ $notice->menu }}</label>
        </div>
        <div>
            <label>値段: {{ $notice->price }}</label>
        </div>
        <div>
            <label>販売開始時間: {{ $notice->start_time }}</label>
        </div>
        <div>
            <label>販売終了時間: {{ $notice->end_time }}</label>
        </div>

        <!-- 投稿するボタン -->
        <form action="{{ route('post.tweet') }}" method="post">
            @csrf
            <input type="hidden" name="notice_id" value="{{ $notice->id }}">
            <button type="submit" class="btn btn-primary">Twitterに投稿する</button>
        </form>

        <!-- 修正するボタン（通知情報登録画面に戻る） -->
        <a href="{{ route('notice.edit', $notice->id) }}" class="btn btn-secondary">修正する</a>
    </div>
@endsection
