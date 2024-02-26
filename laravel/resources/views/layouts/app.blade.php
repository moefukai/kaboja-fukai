<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
{{--    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">--}}
</head>
<body>
@section('header')
    <header>
        <h1 class="logo">Kaboja</h1>
        @if(session('showNavigation', true))
        <div class="drawer">
            <input type="checkbox" name="navToggle" id="navToggle" class="nav-toggle">
            <label for="navToggle" class="btn-burger">
                <span class="icon"></span>
            </label>
            <nav class="nav">
                <ul class="nav-list">
                    <li><a href="{{ route('shops.create') }}">店舗情報登録</a></li>
                    <li><a href="{{ route('notice.create') }}">X投稿作成</a></li>
                    <li><a href="{{ route('check.order.show') }}">オーダー確認</a></li>
{{--                    <li><a href="{{ route('logout') }}">ログアウト</a></li>--}}
                </ul>
            </nav>
        </div>
        @endif
    </header>
@show
    <div id="app">
{{--        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">--}}
{{--            <div class="container">--}}
{{--                <a class="navbar-brand" href="{{ url('/') }}">--}}
{{--                    {{ config('app.name', 'Laravel') }}--}}
{{--                </a>--}}
{{--                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">--}}
{{--                    <span class="navbar-toggler-icon"></span>--}}
{{--                </button>--}}

{{--                <div class="collapse navbar-collapse" id="navbarSupportedContent">--}}
{{--                    <!-- Left Side Of Navbar -->--}}
{{--                    <ul class="navbar-nav me-auto">--}}

{{--                    </ul>--}}

{{--                    <!-- Right Side Of Navbar -->--}}
{{--                    <ul class="navbar-nav ms-auto">--}}
{{--                        <!-- Authentication Links -->--}}
{{--                        @guest--}}
{{--                            @if (Route::has('login'))--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>--}}
{{--                                </li>--}}
{{--                            @endif--}}

{{--                            @if (Route::has('register'))--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>--}}
{{--                                </li>--}}
{{--                            @endif--}}
{{--                        @else--}}
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link" href="{{ route('shops.create') }}">店舗情報登録</a>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link" href="{{ route('notice.create') }}">投稿作成</a>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link" href="{{ route('check.order.show') }}">オーダー確認</a>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item dropdown">--}}
{{--                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>--}}
{{--                                    {{ Auth::user()->name }}--}}
{{--                                </a>--}}

{{--                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">--}}
{{--                                    <a class="dropdown-item" href="{{ route('logout') }}"--}}
{{--                                       onclick="event.preventDefault();--}}
{{--                                                     document.getElementById('logout-form').submit();">--}}
{{--                                        {{ __('Logout') }}--}}
{{--                                    </a>--}}

{{--                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">--}}
{{--                                        @csrf--}}
{{--                                    </form>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                        @endguest--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </nav>--}}

        <main>
            @yield('content')
        </main>
    </div>
    @stack('scripts')
</body>
</html>

<style>
    body {
        background: #FDF7EE;
    }
    header {
        position: relative;
        padding: 15px 0 0 0px;
        background-color: #fff;
    }
    .btn-burger {
        cursor: pointer;
        display: block;
        width: 56px;
        height: 60px;
        position: absolute;
        top: 5px;
        right: 10px;
    }
    .icon, .icon:before, .icon:after {
        position: absolute;
        top: 0;
        right: 0;
        left: 0;
        bottom: 0;
        height: 2px; /* 線の太さ */
        width: 35px; /* 線の長さ */
        background-color: #444;
        border-radius: 2px;
        display: block;
        content: '';
        cursor: pointer;
        margin: auto;
    }

    /* 三本線の間隔 */
    .icon:before {
        top: 20px;
    }
    .icon:after {
        top: -20px;
    }

    /* チェックボックス非表示 */
    .nav-toggle {
        display: none;
    }

    /* アイコンをクリックしたら */
    .nav-toggle:checked ~ .btn-burger .icon {
        background: transparent;
    }
    .nav-toggle:checked ~ .btn-burger .icon:before {
        transform: rotate(-45deg);
        top: 0;
    }
    .nav-toggle:checked ~ .btn-burger .icon:after {
        transform: rotate(45deg);
        top: 0;
    }
    .icon, .icon:before, .icon:after {
        transition: all .8s;
    }
    .nav {
        background-color: #FFE1AA;
    }
    .nav-list a {
        display: block;
        text-decoration: none;
        color: #2E2A23;
    }

    .nav-list {
        list-style: none;
        display: none;
        margin: 0;
        padding-left: 20px;
    }

    .nav-list li {
        margin: 0;
        padding: 10px;
    }

    .nav-toggle:checked ~ .nav .nav-list {
        display: block;
    }

    @media screen and (min-width: 768px) {
        .btn-burger {
            display: none;  /* 768px以上では使用しない */
        }
        header {
            padding: 30px 0 0;
        }
        .logo {
            width: auto;
            margin: 0 0 20px;
            padding: 0;
            text-align: center;
        }
        .nav-toggle:checked ~ .nav .nav-list {
            display: none;
        }
        .nav {
            height: 75px;
        }
        .nav-list {
            display: flex;
            justify-content: center;
            height: 75px;
            align-items: center;
        }
        .nav-list li:not(:last-child) {
            border-right: 1px solid #fff;
        }
    }
</style>
