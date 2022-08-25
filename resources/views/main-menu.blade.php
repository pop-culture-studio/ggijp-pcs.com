<nav class="bg-white dark:bg-black border-b border-gray-100 fixed top-0 left-0 right-0 z-50">
    <!-- Primary Navigation Menu -->
    <div class="max-w-full mx-auto pl-2 pr-0 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
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
            <div class="space-x-1 flex justify-end">
                <x-jet-nav-link href="{{ route('home') }}#popular" class="whitespace-nowrap">
                    {{ __('人気') }}
                </x-jet-nav-link>
                <x-jet-nav-link href="{{ route('home') }}#new" class="whitespace-nowrap">
                    {{ __('新着') }}
                </x-jet-nav-link>
                <x-jet-nav-link href="{{ route('home') }}#category" class="whitespace-nowrap">
                    {{ __('カテゴリー') }}
                </x-jet-nav-link>
                <x-jet-nav-link href="https://www.instagram.com/miraizu_souko/" target="_blank">
                   <x-icon.instagram/><span class="sr-only">Instagram</span>
                </x-jet-nav-link>
            </div>

        </div>
    </div>
    <div class="text-right pr-2 sm:pr-6">
        <a href="{{ route('form.contact') }}" class="font-medium text-gray-500 hover:text-gray-700">ご依頼はこちら</a>
    </div>
</nav>
