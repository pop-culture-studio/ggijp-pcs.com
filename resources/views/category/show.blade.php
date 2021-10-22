<x-main-layout>
    <x-slot name="side">

    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <span><a href="{{ url()->previous() }}" class="text-indigo-500 underline">戻る</a></span>

            <div class="my-6 flex flex-wrap gap-4">
                @foreach ($category->materials as $material)
                    <x-new-item :material="$material" :image="route('file', $material)" :name="$material->title">
                    </x-new-item>
                @endforeach
            </div>

        </div>
    </div>
</x-main-layout>
