{{-- resources/views/twitter_test.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Twitter テスト投稿</h1>
        <form action="/tweet" method="post">
            @csrf
            <div class="form-group">
                <label for="tweet">テスト文:</label>
                <textarea name="tweet" id="tweet" rows="4" class="form-control">ここにテスト文を入力してください</textarea>
            </div>
            <button type="submit" class="btn btn-primary">テスト投稿</button>
        </form>
    </div>
@endsection
