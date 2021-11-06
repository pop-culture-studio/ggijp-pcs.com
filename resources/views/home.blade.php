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
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-4xl hidden">{{ config('app.name', 'Laravel') }}</h1>

            <div class="w-auto h-64 rounded shadow-lg my-10 p-3 bg-indigo-500 text-white">
                <x-admin-message text="この辺に大きいロゴ" />
            </div>

            @isset($materials)
                @include('home.new')
            @endisset

            @include('home.category')

        </div>
    </div>
</x-main-layout>
