<nav class="bg-white border-b border-gray-100 fixed top-0 left-0 right-0 z-50">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('images/logo.png') }}"
                             alt="{{ config('app.name') }}"
                             title="{{ config('app.name') }}"
                             class="block h-9 w-auto">
                    </a>
                </div>
            </div>

            <!-- Navigation Links -->
            <div class="space-x-8 -my-px ml-10 flex justify-end">
                <x-jet-nav-link href="{{ route('home') }}#popular">
                    {{ __('人気') }}
                </x-jet-nav-link>
                <x-jet-nav-link href="{{ route('home') }}#new">
                    {{ __('新着') }}
                </x-jet-nav-link>
                <x-jet-nav-link href="{{ route('home') }}">
                    {{ __('キーワード一覧') }}
                </x-jet-nav-link>
                @can('create', App\Models\Material::class)
                    <x-jet-nav-link href="{{ route('dashboard') }}" class="text-indigo-500">
                        {{ __('ダッシュボード') }}
                    </x-jet-nav-link>
                @endcan
            </div>
        </div>
    </div>
</nav>
