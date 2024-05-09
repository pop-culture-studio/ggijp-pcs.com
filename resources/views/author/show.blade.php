<x-main-layout>
    <x-slot name="title">
        {{ $author }}
    </x-slot>

    <x-slot name="ogp">
        <x-ogp>
            <x-slot name="title">
                {{ $author }}
            </x-slot>

            <x-slot name="description">
                {{ $author }}の素材一覧
            </x-slot>
        </x-ogp>
    </x-slot>

    <div class="py-6">
        <div class="px-3 sm:px-6 lg:px-8">

            <x-breadcrumbs-back/>

            @includeIf('category-menu')

            <x-h2 class="my-6">{{ $author }}の素材一覧</x-h2>

            <div class="my-6">
                <div class="flex flex-wrap gap-4 justify-center">
                    @foreach ($materials as $material)
                        <livewire:material.item :material="$material"></livewire:material.item>
                    @endforeach
                </div>
            </div>

            <div class="flex justify-center">
                {{ $materials->links() }}
            </div>

        </div>
    </div>
</x-main-layout>
