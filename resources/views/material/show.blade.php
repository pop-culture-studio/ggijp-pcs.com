<x-main-layout>
    <x-slot name="side">

    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <span><a href="{{ url()->previous() }}" class="text-indigo-500 underline">戻る</a></span>

            <h2 class="text-3xl my-6">{{ $material->title }}</h2>

            <div>Name : {{ $material->user->name }}</div>

            <div class="bg-indigo-500 text-white p-3 rounded-lg">{!! nl2br(e($material->description)) !!}</div>

            <div class="flex justify-center rounded-lg">
                <img class="object-contain h-full w-auto" src="{{ route('file', $material) }}"
                    alt="{{ $material->title }}" title="{{ $material->title }}" loading="lazy">
            </div>


        </div>
    </div>
</x-main-layout>
