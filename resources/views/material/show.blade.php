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

            <div class="flex flex-auto flex-wrap gap-2 mt-3">カテゴリー :
                @foreach ($material->categories as $cat)
                    <x-category :url="route('category.show', $cat)" :name="$cat->name" />
                @endforeach
            </div>

            <h2 class="text-3xl mb-6">{{ $material->title }}</h2>

            <div>作者 : {{ $material->user->name }}</div>

            @if ($material->description)
                <div class="bg-gray-100 p-3 rounded-lg">{!! nl2br(e($material->description)) !!}</div>
            @endif

            @can('update', $material)
                <div class="p-1 m-1 text-right"><a href="{{ route('material.edit', $material) }}"
                        class="text-red-500 hover:underline">編集</a></div>
            @endcan

            <div class="flex justify-center rounded-lg">
                <img class="object-contain h-full w-auto" src="{{ $material->thumbnail }}"
                    alt="{{ $material->title }}" title="{{ $material->title }}" loading="lazy">
            </div>

            <a href="{{ URL::temporarySignedRoute('download', now()->addMinutes(60), $material) }}">
                <div class="w-full text-center text-3xl p-5 m-5 text-white bg-indigo-500 hover:bg-indigo-600 rounded-lg">
                    {{ __('ダウンロード') }}
                </div>
            </a>

        </div>
    </div>
</x-main-layout>
