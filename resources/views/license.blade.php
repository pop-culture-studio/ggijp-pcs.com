<x-main-layout>
    <x-slot name="title">
        {{ __('利用規約・ライセンス') }}
    </x-slot>

    <div class="py-6">
        <div class="sm:px-6 lg:px-8">
            <h1 class="text-4xl my-10">{{ config('app.name') }} {{ __('利用規約・ライセンス') }}</h1>

            <div class="prose prose-indigo prose-a:text-indigo-500">
                {!! Str::markdown(File::get(resource_path('markdown/terms.md'))) !!}

                <a href="https://creativecommons.org/licenses/by/4.0/deed.ja" target="_blank">
                    <img src="{{ asset('images/cc-by.png') }}" alt="CC BY 4.0">
                </a>

            </div>
        </div>

    </div>
</x-main-layout>
