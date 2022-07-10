<x-main-layout>
    <x-slot name="title">
        {{ request('q', 'すべての素材') }}
    </x-slot>

    <x-slot name="ogp">
        <x-ogp>
            <x-slot name="title">
                {{ request('q', 'すべての素材') }}
            </x-slot>

            <x-slot name="description">
                {{ request('q', config('app.name')) }}
            </x-slot>
        </x-ogp>
    </x-slot>

    <div class="py-6">
        <div class="px-3 sm:px-6 lg:px-8">

            <x-breadcrumbs-back/>

            @includeIf('search')

            @includeIf('category-menu')

            <x-h2 class="my-6">{{ request('q', 'すべての素材') }}</x-h2>

            <div>
                <div class="my-6 flex flex-wrap gap-4">
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
