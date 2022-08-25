<x-main-layout>
    <x-slot name="title">
        プライバシーポリシー
    </x-slot>

    <div class="py-6">
        <div class="sm:px-6 lg:px-8">
            <div class="prose prose-blue dark:prose-invert prose-a:text-blue-500 max-w-none mt-6 p-6">
                {!! $policy !!}
            </div>
        </div>
    </div>
</x-main-layout>
