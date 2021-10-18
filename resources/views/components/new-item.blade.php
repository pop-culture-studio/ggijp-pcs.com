<div class="bg-white w-52">
    <div class="flex justify-center border-4 hover:border-indigo-500 rounded-lg">
        <img class="object-contain h-52" src="{{ empty($image) ? asset('images/01.png') : $image }}" alt="{{ $name }}" title="{{ $name }}">
    </div>
    <span class="font-bold">{{ $name }}</span>
</div>
