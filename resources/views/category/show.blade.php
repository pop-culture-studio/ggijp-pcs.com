<x-main-layout>
    <x-slot name="title">
        カテゴリー {{ $category->name }}
    </x-slot>

    <x-slot name="description">
        {{ $category->description }}
    </x-slot>

    <x-slot name="ogp">
        <x-ogp>
            <x-slot name="title">
                {{ $category->name }}
            </x-slot>

            <x-slot name="description">
                {{ $category->description }}
            </x-slot>
        </x-ogp>
    </x-slot>

    <div class="py-6">
        <div class="px-3 sm:px-6 lg:px-8">

            <x-breadcrumbs-back/>

            @includeIf('search')

            @includeIf('category-menu')

            <x-h2 class="my-6">{{ $category->name }}
                <x-category-count :name="$category->name" class="ml-1"></x-category-count>
            </x-h2>

            @if (filled($category->description))
                <div
                    class="text-sm bg-indigo-100 dark:bg-indigo-600 p-3 rounded-lg">
                    {{ $category->description }}
                    <div class="font-bold">この説明はChatGPTによる自動生成です。
                        @auth
                            <livewire:material.update-chat :category="$category"></livewire:material.update-chat>
                        @endauth
                    </div>
                </div>
            @endif

            <div class="my-6">
                <div class="flex flex-wrap gap-4 justify-center">
                    @foreach ($materials as $material)
                        <livewire:material.item :material="$material"></livewire:material.item>
                    @endforeach
                </div>

                {{ $materials->links() }}
            </div>

        </div>
    </div>
</x-main-layout>
