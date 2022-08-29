<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@isset($title){{ $title }} | @endisset{{ config('app.name', 'Laravel') }}</title>

    @isset($description)
        <meta name="description" content="{{ $description }}">
    @endisset

    @isset($ogp)
        {{ $ogp }}
    @endisset

    <!-- Fonts -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c:wght@400;500;600;700;800;900&display=swap">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles

    @includeIf('layouts.ads')
</head>
<body>
<div class="font-sans bg-white dark:bg-black text-gray-900 dark:text-white antialiased relative">

    <div class="flex flex-col sm:flex-row max-w-full mx-auto">
        @include('main-menu')

        <main class="flex-initial flex-grow">
            <div class="mt-16">
                {{ $slot }}
            </div>
        </main>
    </div>

    @include('layouts.footer')

    <div class="pcs:back-to-top">
        <a href="#" class="pcs:back-to-top-button">↑</a>
    </div>
</div>

@livewireScripts

</body>
</html>
