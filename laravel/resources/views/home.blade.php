@extends('layouts.app')

@section('content')
    <div class="container d-flex justify-content-center align-items-center" style="background-color: #FDF7EE; min-height: 100vh;">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="d-flex flex-column align-items-center">
                    <a href="{{ route('shops.create') }}" class="btn btn-lg" style="background-color: #5C9757; color: white; margin-bottom: 20px; padding: 10px 30px; font-size: 18px;">店舗情報登録</a>
                    <a href="{{ route('notice.create') }}" class="btn btn-lg" style="background-color: #5C9757; color: white; padding: 10px 30px; font-size: 18px;">X投稿作成</a>
                    <a href="{{ route('check.order.show') }}" class="btn btn-lg" style="background-color: #5C9757; color: white; padding: 10px 30px; font-size: 18px;">オーダー確認</a>
                </div>
            </div>
        </div>
    </div>
@endsection
