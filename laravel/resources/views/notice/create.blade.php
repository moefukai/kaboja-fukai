@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>ロス登録</h1>
        <form action="{{ route('notice.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="address">出店場所</label>
                <input type="text" class="form-control" id="address" name="address" required>
            </div>
            <div class="form-group">
                <label for="message">売れ残っているメニュー</label>
                <textarea class="form-control" id="menu" name="menu" required></textarea>
            </div>
            <div class="form-group">
                <label for="price">値段</label>
                <textarea class="form-control" id="price" name="price" required></textarea>
            </div>
            <div class="form-group">
                <label for="message">販売開始時間</label>
                <textarea class="form-control" id="start_time" name="start_time" required></textarea>
            </div>
            <div class="form-group">
                <label for="message">販売終了時間</label>
                <textarea class="form-control" id="end_time" name="end_time" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">登録する</button>
        </form>
    </div>
@endsection
