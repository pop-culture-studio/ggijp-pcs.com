<x-main-layout>
    <x-slot name="side">

    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-4xl hidden">{{ config('app.name', 'Laravel') }}</h1>

            <div class="w-auto h-64 rounded shadow-lg my-10 p-10 bg-indigo-500 text-white">この辺に大きいロゴ</div>

            <h2 class="text-3xl">新着</h2>

            <div class="m-1  flex flex-wrap gap-4">

               <x-new-item :image="asset('images/01.png')" name="1 Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."></x-new-item>
               <x-new-item :image="asset('images/02.png')" name="2"></x-new-item>
               <x-new-item :image="asset('images/03.png')" name="3"></x-new-item>
               <x-new-item :image="asset('images/04.png')" name="4"></x-new-item>
               <x-new-item :image="asset('images/05.png')" name="5"></x-new-item>
               <x-new-item :image="asset('images/06.png')" name="6"></x-new-item>
               <x-new-item :image="asset('images/07.png')" name="7"></x-new-item>
               <x-new-item :image="asset('images/08.png')" name="8"></x-new-item>
               <x-new-item image="{{ $i ?? '' }}" name="9"></x-new-item>
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
