@extends('layouts.app')

@section('content')
    <style>
    .info {
    background-color: #FFF;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    /*.container {*/
    /*    background-color: #FDF7EE;*/
    /*    padding: 20px;*/
    /*    border-radius: 10px;*/
    /*    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);*/
    /*}*/

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
    white-space: nowrap; /* テキストが折り返されないように設定 */
    overflow: hidden; /* はみ出した内容を非表示に */
    text-overflow: ellipsis; /* はみ出したテキストを省略記号で表示 */
    }

    .register {
    display: flex;
    justify-content: center;
    }

    .register button {
    fill: #5C9757;
    width: 100px;
    height: 40px;
    border: solid 1px #5C9757;
    border-radius: 5px;
    background-color: #5C9757;
    color: #fff;
    cursor: pointer;
    margin-top: 20px;
    }

    .peer:focus + .peer-focused-custom {
    border-color: #F6AE2C;
    }

    .select-focused-custom:focus {
    outline: none;
    border-color: #F6AE2C;
    box-shadow: 0 0 0 2px #F6AE2C;
    }

    a {
    margin-top: 20px;
    }
    </style>
<div class="container">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="container-texts">
                    <h1>新規登録</h1>
                    <div class="info">
                    <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('名前') }}</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('メールアドレス') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('パスワード') }}</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('パスワード（確認用）') }}</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    <div class="register">
                    <button type="submit" class="btn btn-primary">
                            {{ __('登録する') }}
                        </button>
                    </div>
                    </div>
                </div>
            </form>
        </div>
</div>
@endsection
