<div class="bg-white dark:bg-black w-72 sm:w-56 text-center mx-auto sm:mx-0 relative">
    <a href="{{ route('material.show', $material) }}">
        <div class="text-sm font-bold grid place-content-center h-14 w-14 bg-white dark:bg-indigo-800 absolute left-0 top-0 rounded-full ring-2 ring-{{ $material->categoryColor }} text-{{ $material->categoryColor }}">{{ $material->categories()->first()?->name ?? '' }}</div>
        <div class="dark:bg-gray-800 flex justify-center ring-2 ring-{{ $material->categoryColor }} hover:ring-4 shadow-lg rounded-full overflow-hidden">
            <img class="object-cover h-72 sm:h-56"
                 src="{{ empty($image) ? 'https://placehold.jp/ffffff/999999/350x350.png?text='.urlencode('Not Found') : $image }}"
                 alt="{{ $name }}" title="{{ $name }}"
                 width="350" height="350">
        </div>
        <span class="font-bold hover:text-indigo-500">{{ $name }}</span>
    </a>
</div>
