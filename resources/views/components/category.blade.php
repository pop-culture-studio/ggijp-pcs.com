<a href="{{ $url }}"
    class="text-md text-black bg-white border border-indigo-500 shadow-sm py-1 px-2 rounded-lg hover:border-indigo-800">
    {{ $name }}
    @isset($count) <span class="text-xs text-gray-500">[{{ $count }}]</span> @endisset
</a>
