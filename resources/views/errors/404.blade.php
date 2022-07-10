<x-main-layout>
    <x-slot name="title">
        {{ __('ページが見つかりません') }}
    </x-slot>

    <div class="py-6">
        <div class="sm:px-6 lg:px-8">
            <x-h2 class="my-6">{{ __('ページが見つかりません') }}</x-h2>

            @includeIf('search')

            @includeIf('category-menu')
        </div>
    </div>
</x-main-layout>
