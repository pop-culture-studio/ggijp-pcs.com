<x-main-layout>
    <x-slot name="title">
        カテゴリー {{ $category->name }}
    </x-slot>

    <div class="py-6">
        <div class="px-3 sm:px-6 lg:px-8">

            <x-breadcrumbs-back/>

            @includeIf('search')

            @includeIf('category-menu')

            <x-gradient-h2 class="my-6">{{ $category->name }}</x-gradient-h2>

            <div class="my-6">
                <div class="flex flex-wrap gap-4">
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
