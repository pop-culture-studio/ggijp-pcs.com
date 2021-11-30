<h2 class="text-3xl mt-6">カテゴリー</h2>

<div class="my-6 mx-3 grid grid-flow-row grid-cols-3 gap-4">
    {{-- 3ヵ月分の季節カテゴリーを表示 --}}
    @foreach (range(0, 2) as $index)
        <div class="w-auto">
            <a href="{{ route('category.show', config('pcs.months')[today()->addMonths($index)->month - 1]['id']) }}"
               title="{{ today()->addMonths($index)->month }}月">
                <img src="{{ asset('images/month/' . today()->addMonths($index)->month . '.png') }}"
                     alt="{{ today()->addMonths($index)->month }}月">
            </a>
        </div>
    @endforeach
</div>

<div class="my-6 mx-3 grid grid-flow-row grid-cols-3 gap-4">
    {{-- 基本カテゴリーを表示 --}}
    @foreach (config('pcs.category') as $cat)
        <div class="w-auto">
            <a href="{{ route('category.show', Arr::get($cat, 'id')) }}" title="{{ Arr::get($cat, 'title') }}">
                <img src="{{ asset('images/cat/' . Arr::get($cat, 'image')) }}" alt="{{ Arr::get($cat, 'title') }}">
            </a>
        </div>
    @endforeach

</div>
