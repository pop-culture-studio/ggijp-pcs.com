<h2 class="text-3xl">カテゴリー</h2>

<div class="my-6 mx-3 grid grid-flow-col grid-cols-3 gap-4">
    {{-- 3ヵ月分の季節カテゴリーを表示 --}}
    <div class="w-auto">
        <a href="{{ route('category.show', config('pcs.months')[today()->month - 1]['id']) }}">
            <img src="{{ asset('images/month/' . today()->month . '.png') }}">
        </a>
    </div>

    <div class="w-auto">
        <a href="{{ route('category.show', config('pcs.months')[today()->addMonth()->month - 1]['id']) }}">
            <img src="{{ asset('images/month/' . today()->addMonth()->month . '.png') }}">
        </a>
    </div>

    <div class="w-auto">
        <a href="{{ route('category.show', config('pcs.months')[today()->addMonths(2)->month - 1]['id']) }}">
            <img src="{{ asset('images/month/' . today()->addMonths(2)->month . '.png') }}">
        </a>
    </div>
</div>

<div class="my-6 mx-3 grid grid-flow-row grid-cols-3 grid-rows-3 gap-4">

    {{-- 基本カテゴリーを表示 --}}
    @foreach (config('pcs.category') as $cat)
        <div class="w-auto">
            <a href="{{ route('category.show', Arr::get($cat, 'id')) }}" title="{{ Arr::get($cat, 'title') }}">
                <img src="{{ asset('images/cat/' . Arr::get($cat, 'image')) }}" alt="{{ Arr::get($cat, 'title') }}">
            </a>
        </div>
    @endforeach

</div>
