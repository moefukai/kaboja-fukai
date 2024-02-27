@extends('layouts.app')

@section('content')
    <style>
        .info {
            background-color: #FFF;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .info2 {
            background-color: #FFF;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            text-align: center;
            border: solid 1px #5C9757;
            color: #5C9757;
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

        .new-account {
            margin-top: 20px;
        }

    </style>
<div class="container">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="container">
                    <div class="container-texts">
                        <h1>ログイン</h1>
                        <div class="info">
                                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('メールアドレス') }}</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('パスワード') }}</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                    <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('パスワード（確認用）') }}</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('パスワードを忘れた場合') }}
                                </a>
                            @endif
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                {{ __('ログイン情報を記憶する') }}
                            </label>
                        </div>

                        <div class="register">
                            <button type="submit" class="btn btn-primary">
                                {{ __('ログイン') }}
                            </button>
                        </div>
                            </div>
                        </div>
                    <div class="info2">
                        <a href="/register" class="new-account">新規登録はこちらから</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
