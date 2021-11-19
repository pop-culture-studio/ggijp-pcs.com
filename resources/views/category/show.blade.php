<x-main-layout>
    <x-slot name="title">
        カテゴリー {{ $category->name }}
    </x-slot>

    <x-slot name="side">

    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8">

            <x-breadcrumbs-back />

            <h2 class="text-9xl text-white bg-gradient-to-r from-indigo-500 to-white p-6 my-6 rounded-lg">{{ $category->name }}</h2>

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
