<x-main-layout>
    <x-slot name="title">
        カテゴリー {{ $category->name }}
    </x-slot>

    <x-slot name="ogp">
        <x-ogp>
            <x-slot name="title">
                {{ $category->name }}
            </x-slot>

            <x-slot name="description">
                {{ $category->name }}カテゴリーの素材一覧
            </x-slot>
        </x-ogp>
    </x-slot>

    <div class="py-6">
        <div class="px-3 sm:px-6 lg:px-8">

            <x-breadcrumbs-back/>

            @includeIf('search')

            @includeIf('category-menu')

            <x-h2 class="my-6">{{ $category->name }}<x-category-count :name="$category->name" class="ml-1"></x-category-count></x-h2>

            <div class="my-6">
                <div class="flex flex-wrap gap-4 justify-center">
                    @foreach ($materials as $material)
                        <x-item :material="$material" :image="$material->image" :name="$material->title">
                        </x-item>
                    @endforeach
                </div>

                {{ $materials->links() }}
            </div>

        </div>
    </div>
</x-main-layout>
