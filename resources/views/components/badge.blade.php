@props(['title'])

<div class="my-3">
    <div class="inline-flex">
        <span class="min-w-max bg-indigo-500 text-white rounded-l-lg px-3">{{ $title }}</span>
        <span class="rounded-r-lg border border-indigo-500 bg-white text-gray-800 font-bold px-3">{{ $slot }}</span>
    </div>
</div>
