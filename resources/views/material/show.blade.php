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

            <x-breadcrumbs-back/>

            <div class="grid grid-cols-2 py-6">
                <div>
                    <x-preview :material="$material"/>
                </div>

                <div>
                    <h2 class="text-3xl font-extrabold my-6">{{ $material->title }}</h2>

                    @if ($material->description)
                        <div class="bg-indigo-100 p-3 rounded-lg">{!! nl2br(e($material->description)) !!}</div>
                    @endif

                    <x-badge title="作者" class="my-3">
                        <a href="{{ route('creator', $material->user) }}"
                           class="text-indigo-500 hover:underline">{{ $material->user->name }}</a>
                    </x-badge>

                    <x-badge title="カテゴリー" class="my-3">
                        @foreach ($material->categories as $cat)
                            <a href="{{ route('category.show', $cat) }}"
                               class="text-indigo-500 hover:underline mx-1">{{ $cat->name }}</a>
                        @endforeach
                    </x-badge>


                    @can('update', $material)
                        <div class="p-1 m-1 text-right"><a href="{{ route('material.edit', $material) }}"
                                                           class="text-red-500 hover:underline">編集</a></div>
                    @endcan

                    <a href="{{ URL::temporarySignedRoute('download', now()->addHours(12), $material) }}">
                        <div
                            class="w-fix text-center text-2xl p-1 sm:p-5 mx-auto text-white bg-indigo-500 hover:bg-indigo-600 rounded-full">
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
                    @foreach($cat->materials()->limit(10)->get() as $rel_material)
                        <x-item :material="$rel_material" :image="$rel_material->image" :name="$rel_material->title">
                        </x-item>
                    @endforeach
                </div>
            @endforeach

        </div>
    </div>
</x-main-layout>
