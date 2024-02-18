<!-- Responsive Navigation Menu -->
<div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
    <div class="pt-2 pb-3 space-y-1">
        <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            {{ __('Dashboard') }}
        </x-responsive-nav-link>
        <!-- 他のナビゲーションリンク -->
        <x-responsive-nav-link :href="route('store.info')">
            {{ __('店舗情報登録') }}
        </x-responsive-nav-link>
        <x-responsive-nav-link :href="route('announcement.create')">
            {{ __('お知らせ作成') }}
        </x-responsive-nav-link>
        <x-responsive-nav-link :href="route('order.confirm')">
            {{ __('オーダー確認') }}
        </x-responsive-nav-link>

        <!-- ログアウトリンク -->
        <x-responsive-nav-link :href="route('logout')"
                               onclick="event.preventDefault();
                            this.closest('form').submit();">
            {{ __('Log Out') }}
        </x-responsive-nav-link>
        <form method="POST" action="{{ route('logout') }}" style="display: none;">
            @csrf
        </form>
    </div>

    <!-- Responsive Settings Options -->
    <div class="pt-4 pb-1 border-t border-gray-200">
        ...
    </div>
</div>

