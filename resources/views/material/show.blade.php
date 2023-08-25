<x-main-layout>
    <x-slot name="title">
        {{ $material->title }}
    </x-slot>

    <x-slot name="description">
        {{ $material->description ?? $material->title ?? config('app.name') }}
    </x-slot>

    <x-slot name="ogp">
        <x-ogp>
            <x-slot name="title">
                {{ $material->title }}
            </x-slot>

            <x-slot name="description">
                {{ $material->description ?? $material->title ?? config('app.name') }}
            </x-slot>

            <x-slot name="image">
                {{ $material->image }}
            </x-slot>
        </x-ogp>
    </x-slot>

    <x-slot name="json_ld">
        <x-json-ld.image :material="$material"/>
    </x-slot>

    <div class="py-6">
        <div class="px-3 sm:px-6 lg:px-8">

            <x-breadcrumbs-back/>

            <div class="sm:grid sm:grid-cols-2 gap-3 py-6">

                <x-preview :material="$material"/>

                <div>
                    <h2 class="text-3xl font-extrabold my-6 text-{{ $material->categoryColor }}">{{ $material->title }}</h2>

                    @if ($material->description)
                        <div
                            class="bg-indigo-100 dark:bg-indigo-600 p-3 rounded-lg">{!! nl2br(e($material->description)) !!}</div>
                    @endif

                    @if($material->author)
                        <x-badge title="作者" class="my-3">
                            <a href="{{ route('author', Str::replace('/', '／', $material->author)) }}"
                               class="text-indigo-500 hover:underline">{{ $material->author }}</a>
                        </x-badge>
                    @endif

                    <x-badge title="カテゴリー" class="my-3">
                        @foreach ($material->categories as $cat)
                            <a href="{{ route('category.show', $cat) }}"
                               class="text-indigo-500 hover:underline mx-1 whitespace-nowrap">{{ $cat->name }}</a>
                        @endforeach
                    </x-badge>

                    @if(cache()->has('mimetype:'.$material->id))
                        <x-badge title="ファイルタイプ" class="my-3">
                            {{ cache('mimetype:'.$material->id) }}
                        </x-badge>
                    @endif

                    @can('update', $material)
                        <div class="p-1 m-1 text-right">
                            <a href="{{ route('material.edit', $material) }}"
                               class="text-red-500 hover:underline">編集</a>
                        </div>
                    @endcan

                    @if (str_contains(Storage::mimeType($material->file), 'zip'))
                        <livewire:material.gallery :material="$material"/>
                    @endif

                    <a href="{{ URL::temporarySignedRoute('download', now()->addHours(12), $material) }}">
                        <div
                            class="w-fix text-center text-xl py-3 px-6 sm:px-16 m-6 mx-auto text-white bg-indigo-500 hover:bg-indigo-600 rounded-full whitespace-nowrap">
                            {{ __('ダウンロード') }}
                        </div>
                    </a>

                </div>
            </div>

            <h3 class="text-2xl py-3">同じカテゴリーの素材</h3>

            @foreach($material->categories as $cat)
                <h4 class="text-xl">
                    <a href="{{ route('category.show', $cat) }}"
                       class="text-indigo-500 hover:underline">{{ $cat->name }}</a>
                </h4>
                <div class="my-6 mx-3 flex flex-wrap gap-4">
                    @foreach($cat->materials()->limit(4)->inRandomOrder()->get() as $rel_material)
                        <livewire:material.item :material="$rel_material" lazy></livewire:material.item>
                    @endforeach
                </div>
            @endforeach

        </div>
    </div>
</x-main-layout>
