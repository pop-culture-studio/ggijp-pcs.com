<x-main-layout>
    <x-slot name="title">
        すべての素材
    </x-slot>

    <x-slot name="ogp">
        <x-ogp>
            <x-slot name="title">
                すべての素材
            </x-slot>

            <x-slot name="description">
                {{ config('app.name') }}
            </x-slot>
        </x-ogp>
    </x-slot>

    <x-slot name="side">

    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8">

            <x-breadcrumbs-back />

            <h2 class="text-3xl my-6">すべての素材</h2>

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
