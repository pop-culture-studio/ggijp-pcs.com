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

    <div class="py-0">
        <div>
            <h1 class="text-4xl hidden">{{ config('app.name', 'Laravel') }}</h1>

            <div class="w-auto h-auto mt-10 bg-white relative">
                <img src="{{ asset('/images/bg_home.png') }}">

                <div class="w-1/2 absolute top-1/3 left-1/4 right-1/4 z-30">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('images/logo_home.png') }}"
                             alt="{{ config('app.name', 'Laravel') }}"
                             title="{{ config('app.name', 'Laravel') }}"
                        >
                    </a>
                </div>
            </div>

            @includeIf('search')

            @includeIf('category-menu')

            <div class="sm:px-6 lg:px-8">

                @if($popular_materials)
                    @include('home.popular')
                @endif

                @if($new_materials)
                    @include('home.new')
                @endif

            </div>
        </div>
    </div>
</x-main-layout>
