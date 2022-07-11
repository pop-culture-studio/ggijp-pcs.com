<x-main-layout>
    <x-slot name="title">
        利用規約
    </x-slot>

    <div class="py-6">
        <div class="sm:px-6 lg:px-8">
            <div class="prose prose-indigo dark:prose-invert prose-a:text-indigo-500 max-w-none mt-6 p-6">
                {!! $terms !!}
            </div>
        </div>
    </div>
</x-main-layout>
