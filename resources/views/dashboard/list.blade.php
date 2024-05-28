<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <h2 class="text-2xl mb-5">自分の素材</h2>

        <div class="p-6 my-3 bg-white dark:bg-black overflow-hidden shadow-xl sm:rounded-lg">
            <table class="table-auto w-full">
                <thead>
                    <tr class="border-b-2 border-indigo-500">
                        <th>ファイル</th>
                        <th>カテゴリー</th>
                        <th>タイトル</th>
                        <th>作者</th>
                        <th>説明</th>
                        <th>編集</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($materials as $material)
                        <tr class="text-center divide-x divide-solid divide-indigo-500 divide-opacity-30 odd:bg-white even:bg-gray-100 dark:odd:bg-gray-700 dark:even:bg-gray-800">
                            <td>
                                <a href="{{ route('material.show', $material) }}">
                                    <img class="object-contain p-1 h-full sm:h-24 mx-auto"
                                        src="{{ $material->image }}" loading="lazy" alt="{{ $material->title }}" title="{{ $material->title }}">
                                </a>
                            </td>

                            <td>{{ Str::limit($material->categories->implode('name', ','), 50) }}</td>
                            <td>{{ Str::limit($material->title, 50) }}</td>
                            <td>{{ Str::limit($material->author, 50) }}</td>
                            <td>{{ Str::limit($material->description, 50) }}</td>
                            <td>
                                <form action="{{ route('material.edit', $material) }}">
                                    <x-button class="min-w-max">
                                        {{ __('編集') }}
                                    </x-button>
                                </form>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>

        <div class="flex justify-center">
            {{ $materials->links() }}
        </div>
    </div>
</div>
