@extends('layouts.app')

@section('content')
<div class="tab-wrapper" role="tablist">
        $tabs = [
            ['id' => 'tab-1', 'label' => '確認待ち', 'panel' => 'panel-1', 'content' => '確認待ちの内容'],
            ['id' => 'tab-2', 'label' => '受け渡し待ち', 'panel' => 'panel-2', 'content' => '受け渡し待ちの内容'],
            ['id' => 'tab-3', 'label' => '注文履歴一覧', 'panel' => 'panel-3', 'content' => '注文履歴一覧の内容'],
        ];
    @foreach($tabs as $index => $tab)
        <div class="tab">
            <input id="{{ $tab['id'] }}" type="radio" name="tab-radio" role="tab" class="tab-input" value="{{ $tab['label'] }}" {{ $index === 0 ? 'checked' : '' }}>
            <h2 class="tab-label-heading"><label class="tab-label" for="{{ $tab['id'] }}">{{ $tab['label'] }}</label></h2>
        </div>
    @endforeach
</div>
@foreach($tabs as $index => $tab)
    <div class="tab-panel {{ $tab['panel'] }}" role="tabpanel">
        <div><p>{{ $tab['content'] }}</p></div>
    </div>
@endforeach
@endsection
