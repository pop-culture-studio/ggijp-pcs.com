<h2 class="text-3xl">カテゴリー</h2>

{{-- <x-admin-message text="ここのカテゴリーは固定カテゴリーと季節ごとの特集カテゴリーなどを配置。" /> --}}

<div class="my-6 mx-3 grid grid-flow-row grid-cols-3 grid-rows-3 gap-4">
    <div class="w-auto">
        <img src="https://placehold.jp/6366F1/ffffff/350x150.png?text={{ urlencode('クリスマス') }}&css=%7B%22border-radius%22%3A%225px%22%7D">
    </div>
    <div class="w-auto">
        <img src="https://placehold.jp/6366F1/ffffff/350x150.png?text={{ urlencode('正月') }}&css=%7B%22border-radius%22%3A%225px%22%7D">
    </div>

    @foreach (config('pcs.category') as $cat)
        <div class="w-auto">
            <a href="{{ route('category.show', Arr::get($cat, 'id')) }}" title="{{ Arr::get($cat, 'title') }}">
                <img src="{{ asset('images/cat/' . Arr::get($cat, 'image')) }}" alt="{{ Arr::get($cat, 'title') }}">
            </a>
        </div>
    @endforeach

</div>
