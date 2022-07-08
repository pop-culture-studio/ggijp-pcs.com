<x-main-layout>
    <x-slot name="title">
        {{ __('よくある質問') }}
    </x-slot>

    <div class="py-6">
        <div class="sm:px-6 lg:px-8">
            <div class="prose prose-indigo prose-a:text-indigo-500 max-w-none mt-6 p-6">
                {!! Str::markdown(File::get(resource_path('markdown/faq.md'))) !!}
            </div>
        </div>
    </div>
</x-main-layout>
