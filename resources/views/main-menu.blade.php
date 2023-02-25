<nav class="bg-white dark:bg-black border-b border-gray-100 fixed top-0 left-0 right-0 z-50">
    <!-- Primary Navigation Menu -->
    <div class="max-w-full mx-auto pl-2 pr-0 sm:px-6 lg:px-8">
        <div class="sm:flex justify-between h-16">
            <div class="flex justify-center sm:justify-start">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('images/logo.png') }}"
                             alt="{{ config('app.name') }}"
                             title="{{ config('app.name') }}"
                             class="block h-8 w-auto">
                    </a>
                </div>
            </div>

            <!-- Navigation Links -->
            <div class="space-x-1 flex justify-center pt-1 sm:pt-0">
                <x-nav-link href="{{ route('form.contact') }}" class="whitespace-nowrap">
                    {{ __('ご依頼はこちら') }}
                </x-nav-link>
                <x-nav-link href="{{ route('home') }}#popular" class="whitespace-nowrap">
                    {{ __('人気') }}
                </x-nav-link>
                <x-nav-link href="{{ route('home') }}#new" class="whitespace-nowrap">
                    {{ __('新着') }}
                </x-nav-link>
                <x-nav-link href="{{ route('home') }}#category" class="whitespace-nowrap">
                    {{ __('カテゴリー') }}
                </x-nav-link>
                <x-nav-link href="https://www.instagram.com/miraizu_souko/" target="_blank">
                   <x-icon.instagram/><span class="sr-only">Instagram</span>
                </x-nav-link>
            </div>

        </div>
    </div>
</nav>
