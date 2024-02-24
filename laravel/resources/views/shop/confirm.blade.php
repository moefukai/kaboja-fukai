@extends('layouts.app')

@section('content')
    <style>
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

    </style>
    <div class="container">
        <div class="container-texts">
        <h1>登録完了</h1>
        <p>ショップの情報が正常に登録されました。</p>
        {{--        <div>--}}
        {{--            <a href="{{ route('shops.edit', ['shop' => $shop->id]) }}" class="btn btn-primary">編集する</a>--}}
        {{--        </div>--}}
        </div>
    </div>
@endsection
