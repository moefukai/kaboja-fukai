@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>お知らせ作成</h1>
        <form action="{{ route('notice.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="address">出店場所</label>
                <input type="text" class="form-control" id="address" name="address" placeholder="出店場所の住所を記入してください" required>
            </div>
            <div id="menus-container">
                <!-- デフォルトのメニュー選択セレクトボックスがここに追加されます -->
            </div>
            <button type="button" id="add-menu-btn">メニューを追加</button>
            <div class="form-group">
                <label for="start_time">販売開始時間</label>
                <select class="form-control" id="start_time" name="start_time" required>
                    @for ($i = 11; $i < 15; $i++)
                        <option value="{{ sprintf('%02d:00', $i) }}">{{ sprintf('%02d:00', $i) }}</option>
                        <option value="{{ sprintf('%02d:30', $i) }}">{{ sprintf('%02d:30', $i) }}</option>
                    @endfor
                </select>
            </div>
            <div class="form-group">
                <label for="end_time">販売終了時間</label>
                <select class="form-control" id="end_time" name="end_time" required>
                    @for ($i = 11; $i < 15; $i++)
                        <option value="{{ sprintf('%02d:00', $i) }}">{{ sprintf('%02d:00', $i) }}</option>
                        <option value="{{ sprintf('%02d:30', $i) }}">{{ sprintf('%02d:30', $i) }}</option>
                    @endfor
                </select>
            </div>
            <button type="submit" class="btn btn-primary">登録する</button>
        </form>
    </div>
    @push('scripts')
        <script src="{{ mix('js/notice-handler.js') }}"></script>
    @endpush
@endsection
