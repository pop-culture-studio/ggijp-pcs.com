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

            <div class="w-auto h-auto my-10 bg-white">
                <a href="{{ route('home') }}" target="_top">
                    <img src="{{ asset('images/logo/top.png') }}"
                         alt="{{ config('app.name', 'Laravel') }}"
                         title="{{ config('app.name', 'Laravel') }}">
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
