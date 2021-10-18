<div class="bg-white w-full sm:w-56">
    <div class="flex justify-center border-4 hover:border-indigo-500 rounded-lg">
        <img class="object-contain h-full sm:h-56" src="{{ empty($image) ? asset('images/01.png') : $image }}" alt="{{ $name }}" title="{{ $name }}" loading="lazy">
    </div>
    <span class="font-bold">{{ $name }}</span>
</div>
