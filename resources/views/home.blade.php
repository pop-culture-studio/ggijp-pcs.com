<x-main-layout>
    <x-slot name="side">

    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-4xl hidden">{{ config('app.name', 'Laravel') }}</h1>

            <div class="w-auto h-64 rounded shadow-lg my-10 p-10 bg-indigo-500 text-white">この辺にロゴ</div>

            <h2 class="text-3xl">新着</h2>

            <div class="m-1 grid grid-flow-row grid-cols-3 grid-rows-3 gap-4">
                <div class="w-auto h-40 bg-gray-100">1</div>
                <div class="w-auto h-40 bg-gray-100">2</div>
                <div class="w-auto h-40 bg-gray-100">3</div>
                <div class="w-auto h-40 bg-gray-100">4</div>
                <div class="w-auto h-40 bg-gray-100">5</div>
                <div class="w-auto h-40 bg-gray-100">6</div>
            </div>

            <h2 class="text-3xl">カテゴリー</h2>

            <div class="m-1 grid grid-flow-row grid-cols-3 grid-rows-3 gap-4">
                <div class="w-auto h-40 bg-gray-100">1</div>
                <div class="w-auto h-40 bg-gray-100">2</div>
                <div class="w-auto h-40 bg-gray-100">3</div>
                <div class="w-auto h-40 bg-gray-100">4</div>
                <div class="w-auto h-40 bg-gray-100">5</div>
                <div class="w-auto h-40 bg-gray-100">6</div>
            </div>
        </div>
    </div>
</x-main-layout>
