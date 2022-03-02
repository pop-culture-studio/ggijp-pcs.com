<aside class="w-full sm:w-64 flex-none sm:min-h-screen sm:order-first order-last p-5 sm:border-r bg-indigo-50">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-5">
        <a href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
    </h2>

    <div class="my-6">
        <form action="{{ route('material.index') }}" method="get" class="flex">
            <x-jet-label for="q" value="{{ __('検索') }}" class="hidden"/>
            <x-jet-input name="q" type="search" class="flex-auto sm:w-1/2 rounded-r-none" value="{{ request('q') }}" placeholder="{{ __('キーワード検索') }}"/>
            <x-jet-button class="rounded-l-none" title="素材のタイトル・説明・作者名・カテゴリーから検索">検索</x-jet-button>
        </form>
    </div>

    <div class="my-6">
        <ul>
            <li>
                <a href="{{ route('contact') }}" class="font-bold text-indigo-500 hover:underline">{{ __('お問い合わせ') }}</a>
            </li>
            <li>
                <a href="{{ route('license') }}" class="font-bold text-indigo-500 hover:underline">{{ __('利用規約・ライセンス') }}</a>
            </li>
        </ul>
    </div>

    @can('create', App\Models\Material::class)
        <div class="border-4 border-indigo-500 my-6 rounded">
            <h2 class="bg-indigo-500 text-lg text-white font-bold px-1">スタッフ＆メンバー用</h2>

            <div class="p-2 bg-white">
                <a href="{{ route('dashboard') }}" class="font-bold text-indigo-500 hover:underline">ダッシュボード</a>

                <div class="text-sm mt-3">
                    <ul>
                        <li>ユーザー数：{{ App\Models\User::count() }}</li>
                        <li>素材数：{{ App\Models\Material::count() }}</li>
                    </ul>
                </div>
            </div>

        </div>
    @endcan

    <h2 class="text-lg">カテゴリー</h2>
    <div class="flex flex-auto flex-wrap gap-3">
        @foreach ($cats as $cat)
            <x-category :url="route('category.show', $cat)" :name="$cat->name" :count="$cat->materials_count" />
        @endforeach
    </div>

    @if (isset($side))
        {{ $side }}
    @endif

    <div class="text-sm mt-10 p-1 border-t">Copyright&copy; <a href="https://pcs-works.vercel.app/" class="font-bold text-indigo-500 hover:underline"
            target="_blank" rel="noopener">ポップカルチャースタジオ未来図</a> All Rights Reserved.</div>
</aside>
