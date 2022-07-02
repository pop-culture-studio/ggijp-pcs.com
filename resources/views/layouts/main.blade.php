<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@isset($title){{ $title }} | @endisset{{ config('app.name', 'Laravel') }}</title>

    @isset($ogp)
    {{ $ogp }}
    @endisset

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800;900&display=swap">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
</head>

<body>
    <div class="font-sans text-gray-900 antialiased">

        <div class="flex flex-col sm:flex-row bg-white max-w-full mx-auto">

            <main class="flex-initial flex-grow">
                @include('main-menu')

                <div class="mt-16">
                    {{ $slot }}
                </div>
            </main>


{{--            @include('side')--}}
        </div>

        @include('layouts.footer')

    </div>

    @livewireScripts

</body>

</html>
