@extends('layouts.app')

@section('content')
    <style>
        .info {
            background-color: #FFF;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            margin-top: 20px;
        }

        .container {
            padding: 20px;
        }

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

        .register {
            display: flex;
            justify-content: center;
        }

        .register button {
            fill: #5C9757;
            min-width: 100px;
            height: 40px;
            border: solid 1px #5C9757;
            border-radius: 5px;
            background-color: #5C9757;
            color: #fff;
            cursor: pointer;
            margin-top: 20px;
            white-space: nowrap; /* テキストが折り返されないように設定 */
            overflow: hidden; /* はみ出した内容を非表示に */
            text-overflow: ellipsis; /* はみ出したテキストを省略記号で表示 */
        }

        .peer:focus + .peer-focused-custom {
            border-color: #F6AE2C;
        }

        .select-focused-custom:focus {
            outline: none;
            border-color: #F6AE2C;
            box-shadow: 0 0 0 2px #F6AE2C;
        }

        .tab {
            /* タブの基本スタイル */
            display: inline-block; /* タブをインラインブロック要素として配置 */
            padding: 8px 16px; /* タブ内のパディング */
            border-bottom: 2px solid transparent; /* 非アクティブタブのボーダー */
            text-decoration: none; /* テキストの下線を除去 */
            color: #6B7280; /* 非アクティブタブのテキストカラー */
            font-size: 0.875rem; /* テキストサイズ */
            font-weight: 500; /* フォントの太さ */
        }

        .tab-active, .tab:hover {
            /* アクティブまたはホバー状態のタブのスタイル */
            color: #F6AE2C; /* アクティブタブのテキストカラー */
            border-bottom-color: #F6AE2C; /* アクティブタブのボーダーカラー */
        }

        .tabs-container {
            /* タブコンテナのスタイル */
            border-bottom: 2px solid #E5E7EB; /* コンテナの下線 */
        }

        .tabs-nav {
            /* タブナビゲーションのスタイル */
            display: flex; /* フレックスボックスを使用 */
            gap: 16px; /* タブ間のギャップ */
            padding-bottom: 4px; /* タブ下のパディングを減らして間隔を縮める */
        }
    </style>
    <div class="container">
        <div class="border-b border-gray-200 pb-5 sm:pb-0">
            <h1 class="text-base font-semibold leading-6 text-gray-900">注文確認</h1>
            <div class="mt-3 sm:mt-4">
                <div class="tabs-container">
                    <nav class="tabs-nav">
                        <a href="{{ route('to.check.show') }}" class="{{ request()->routeIs('to.check.show') ? 'tab-active' : 'tab' }}">確認待ち</a>
                        <a href="{{ route('to.serve.show') }}" class="{{ request()->routeIs('to.serve.show') ? 'tab-active' : 'tab' }}">受け渡し待ち</a>
                        <a href="{{ route('history.show') }}" class="{{ request()->routeIs('history.show') ? 'tab-active' : 'tab' }}">注文履歴一覧</a>
                    </nav>
                </div>
            </div>
        </div>
        <div class="info">
            </div>
        </div>
@endsection
