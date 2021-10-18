<x-main-layout>
    <x-slot name="side">

    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-4xl hidden">{{ config('app.name', 'Laravel') }}</h1>

            <div class="w-auto h-64 rounded shadow-lg my-10 p-10 bg-indigo-500 text-white">この辺に大きいロゴ</div>

            @include('home.new')

            @include('home.category')

        </div>
    </div>
</x-main-layout>
