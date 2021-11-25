<div class="bg-white w-full sm:w-56">
    <a href="{{ route('material.show', $material) }}">
        <div class="flex justify-center border-4 hover:border-indigo-500 rounded-lg">
            <img class="object-contain h-full sm:h-56" src="{{ empty($image) ? asset('images/01.png') : $image }}"
                alt="{{ $name }}" title="{{ $name }}" width="350" height="350">
        </div>
        <span class="font-bold hover:text-indigo-500">{{ $name }}</span>
    </a>
</div>
