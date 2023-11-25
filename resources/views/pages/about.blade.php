<?php
use function Laravel\Folio\name;

name('about');
?>
<x-main-layout>
    <x-slot name="title">
        {{ __('未来図倉庫について') }}
    </x-slot>

    <div class="py-6">
        <div class="sm:px-6 lg:px-8">
            <div class="prose prose-blue dark:prose-invert prose-a:text-blue-500 max-w-none mt-6 p-6">
                {!! Str::markdown(File::get(resource_path('markdown/about.md'))) !!}
            </div>
        </div>
    </div>
</x-main-layout>
