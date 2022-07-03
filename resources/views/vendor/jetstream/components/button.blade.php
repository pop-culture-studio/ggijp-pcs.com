<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-indigo-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-400 active:bg-indigo-500 focus:outline-none focus:border-indigo-500 focus:ring focus:ring-indigo-300 disabled:opacity-25 transition whitespace-nowrap']) }}>
    {{ $slot }}
</button>
