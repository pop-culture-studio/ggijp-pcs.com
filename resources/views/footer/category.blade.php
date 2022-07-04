<div>
    <h2 class="text-2xl sm:text-4xl font-bold text-center text-gray-500" id="category">
        カテゴリーから探す</h2>

    @foreach(config('pcs.keywords') as $key => $cats)
        <div class="mx-auto py-6 px-6 sm:px-36 text-gray-500">
            <h3 class="text-xl font-bold">{{ $key }}</h3>
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
