<a href="{{ $url }}"
    class="text-md text-black bg-white font-bold border border-indigo-500 shadow-sm py-1 px-2 rounded-lg hover:border-indigo-800">
    {{ $name }}
    @isset($count) <span class="text-xs font-normal text-gray-600">[{{ $count }}]</span> @endisset
</a>
