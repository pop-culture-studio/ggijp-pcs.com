<div class="bg-white w-72 sm:w-56 text-center mx-auto sm:mx-0">
    <a href="{{ route('material.show', $material) }}">
        <div class="flex justify-center ring-2 ring-indigo-300 hover:ring-indigo-500 shadow-xl rounded-full overflow-hidden">
            <img class="object-cover h-72 sm:h-56"
                 src="{{ empty($image) ? 'https://placehold.jp/ffffff/999999/350x350.png?text='.urlencode('Not Found') : $image }}"
                 alt="{{ $name }}" title="{{ $name }}"
                 width="350" height="350">
        </div>
        <span class="font-bold hover:text-indigo-500">{{ $name }}</span>
    </a>
</div>
