<div class="bg-white w-full sm:w-56 text-center">
    <a href="{{ route('material.show', $material) }}">
        <div class="flex justify-center border-4 hover:border-indigo-500 rounded-lg sm:rounded-full overflow-hidden">
            <img class="object-cover h-full sm:h-56"
                 src="{{ empty($image) ? 'https://placehold.jp/ffffff/999999/350x350.png?text='.urlencode('Not Found') : $image }}"
                 alt="{{ $name }}" title="{{ $name }}"
                 width="350" height="350">
        </div>
        <span class="font-bold hover:text-indigo-500">{{ $name }}</span>
    </a>
</div>
