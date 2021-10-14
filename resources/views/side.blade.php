<aside class="w-full sm:w-56 flex-none sm:min-h-screen sm:order-first order-last p-5 sm:border-r">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-5">
        <a href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
    </h2>

    <div class="text-white bg-blue-500 bold my-5">サイドバー</div>

    <h2 class="text-lg">カテゴリー</h2>
    <div class="flex flex-auto flex-wrap gap-1">
        <span
            class="text-sm text-black bg-white border border-indigo-500 shadow-md py-1 px-2 rounded-lg hover:bg-indigo-500">カテゴリーA</span>
        <span
            class="text-sm text-black bg-white border border-indigo-500 shadow-md py-1 px-2 rounded-lg hover:bg-indigo-500">カテゴリーB</span>
        <span
            class="text-sm text-black bg-white border border-indigo-500 shadow-md py-1 px-2 rounded-lg hover:bg-indigo-500">カテゴリーC</span>
    </div>

    @if (isset($side))
        {{ $side }}
    @endif
</aside>
