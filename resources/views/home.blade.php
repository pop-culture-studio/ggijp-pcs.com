<x-main-layout>
    <x-slot name="ogp">
        <x-ogp>
            <x-slot name="title">
                {{ config('app.name') }}
            </x-slot>

            <x-slot name="description">
                {{ config('app.name') }}
            </x-slot>
        </x-ogp>
    </x-slot>

    <x-slot name="side">

    </x-slot>

    <div class="py-6">
        <div class="sm:px-6 lg:px-8">
            <h1 class="text-4xl hidden">{{ config('app.name', 'Laravel') }}</h1>

            <div class="w-auto h-auto my-10 bg-white relative">
                <img src="/images/bg_home.png">
                <a href="{{ route('home') }}" target="_top" class="w-1/2 absolute top-1/3 left-1/4 right-1/4 z-50">
                    <img src="{{ asset('images/logo_home.png') }}"
                         alt="{{ config('app.name', 'Laravel') }}"
                         title="{{ config('app.name', 'Laravel') }}"
                    >
                </a>
            </div>

            @includeIf('news')

            @if($materials)
                @include('home.new')
            @endif

            @include('home.category')

        </div>
    </div>
</x-main-layout>
