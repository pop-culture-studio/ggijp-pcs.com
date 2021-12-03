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
                {{ $material->image }}
            </x-slot>
        </x-ogp>
    </x-slot>

    <x-slot name="side">

    </x-slot>

    <div class="py-6">
        <div class="px-3 sm:px-6 lg:px-8">

            <x-breadcrumbs-back />

            <x-badge title="作者" class="my-3">{{ $material->user->name }}</x-badge>

            <h2 class="text-3xl font-extrabold my-6">{{ $material->title }}</h2>

            <x-badge title="カテゴリー" class="my-3">
                @foreach ($material->categories as $cat)
                    <a href="{{ route('category.show', $cat) }}" class="text-indigo-500 hover:underline mx-1">{{ $cat->name }}</a>
                @endforeach
            </x-badge>

            @if ($material->description)
                <div class="bg-indigo-100 p-3 rounded-lg">{!! nl2br(e($material->description)) !!}</div>
            @endif

            @can('update', $material)
                <div class="p-1 m-1 text-right"><a href="{{ route('material.edit', $material) }}"
                        class="text-red-500 hover:underline">編集</a></div>
            @endcan

            <x-preview :material="$material" />

            <a href="{{ URL::temporarySignedRoute('download', now()->addMinutes(60), $material) }}">
                <div class="w-auto text-center text-3xl p-5 m-5 text-white bg-indigo-500 hover:bg-indigo-600 rounded-lg">
                    {{ __('ダウンロード') }}
                </div>
            </a>

        </div>
    </div>
</x-main-layout>
