<div>
    <x-h2 class="mt-6" id="category">
        キーワードから探す
    </x-h2>

    @foreach(config('category') as $key => $cats)
        <div class="mx-auto py-6 px-6 sm:px-36 text-gray-500 dark:text-white">
            <h3 class="text-xl font-bold">
                <a href="{{ route('category.show', $key) }}" class="hover:underline">
                    {{ $key }}
                </a>
                <span class="text-gray-300"> [{{ \App\Models\Category::query()->withCount('materials')->where('name', $key)->first()->materials_count ?? '' }}]</span>
            </h3>
            <ul role="list" class="flex flex-wrap gap-3 justify-start whitespace-nowrap">
                @foreach($cats as $cat)
                    <li>
                        <a href="{{ route('category.show', $cat) }}" class="hover:underline">
                            #{{ $cat }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    @endforeach
</div>
