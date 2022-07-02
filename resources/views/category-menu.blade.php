<div class="my-3 mx-0 sm:mx-6 grid grid-flow-col gap-4">
    @foreach (config('pcs.category') as $cat)
        <div class="w-auto">
            <a href="{{ route('category.show', Arr::get($cat, 'id')) }}" title="{{ Arr::get($cat, 'title') }}" class="hover:opacity-80">
                <img src="{{ asset('images/cat/' . Arr::get($cat, 'image')) }}" alt="{{ Arr::get($cat, 'title') }}" class="h-10 sm:h-20">
                <div class="whitespace-nowrap font-bold text-center mt-1 {{ Arr::get($cat, 'color') }}">{{ Arr::get($cat, 'title') }}</div>
            </a>
        </div>
    @endforeach

</div>
