<x-main-layout>
    <x-slot name="title">
        {{ $material->title }}
    </x-slot>

    <x-slot name="ogp">
        <x-ogp>
            <x-slot name="title">
                {{ $material->title }}
            </x-slot>

            <x-slot name="description">
                {{ $material->description ?? config('app.name') }}
            </x-slot>

            <x-slot name="image">
                {{ $material->thumbnail }}
            </x-slot>
        </x-ogp>
    </x-slot>

    <x-slot name="side">

    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <x-breadcrumbs-back />
            
            <h2 class="text-3xl my-6">{{ $material->title }}</h2>

            <div>名前 : {{ $material->user->name }}</div>
            <div class="flex flex-auto flex-wrap gap-1">カテゴリー :
                @foreach ($material->categories as $cat)
                    <x-category :url="route('category.show', $cat)" :name="$cat->name" />
                @endforeach
            </div>

            <div class="bg-gray-100 p-3 rounded-lg">{!! nl2br(e($material->description)) !!}</div>

            <div class="flex justify-center rounded-lg">
                <img class="object-contain h-full w-auto" src="{{ $material->thumbnail }}"
                    alt="{{ $material->title }}" title="{{ $material->title }}" loading="lazy">
            </div>

            <a href="{{ route('download', $material) }}">
                <div class="text-center text-4xl p-6 m-6 text-white bg-indigo-500 hover:bg-indigo-400 rounded-lg">
                    ダウンロード
                </div>
            </a>

        </div>
    </div>
</x-main-layout>
