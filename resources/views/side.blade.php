<aside class="w-full sm:w-56 flex-none sm:min-h-screen sm:order-first order-last p-5 sm:border-r">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-5">
        <a href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
    </h2>

    <h2 class="text-lg">カテゴリー</h2>
    <div class="flex flex-auto flex-wrap gap-1">
        <span
            class="text-sm text-black bg-white border border-indigo-500 shadow-md py-1 px-2 rounded-lg hover:bg-indigo-500">カテゴリーA</span>
        <span
            class="text-sm text-black bg-white border border-indigo-500 shadow-md py-1 px-2 rounded-lg hover:bg-indigo-500">カテゴリーB</span>
        <span
            class="text-sm text-black bg-white border border-indigo-500 shadow-md py-1 px-2 rounded-lg hover:bg-indigo-500">カテゴリーC</span>
    </div>

    @auth
        <div class="border-4 border-indigo-500 my-6 p-1">
            <h2 class="bg-indigo-500 text-lg text-white bold">管理者＆メンバー用</h2>
            <a href="{{ route('dashboard') }}" class="text-indigo-500 hover:underline">ダッシュボード</a>
        </div>
    @endauth

    @if (isset($side))
        {{ $side }}
    @endif

    <div class="text-xs mt-10 p-1 border-t">Copyright&copy; <a href="https://sds.fukuoka.jp/" target="_blank">ポップカルチャースタジオ未来図</a> All Rights Reserved.</div>
</aside>
