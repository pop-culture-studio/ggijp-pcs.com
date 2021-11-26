<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <h2 class="text-2xl mb-5">未来図倉庫チームの素材一覧</h2>

        <div class="p-6 bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <table class="table-auto w-full">
                <thead>
                    <tr class="border-b-2 border-indigo-500">
                        <th>ID</th>
                        <th>ファイル</th>
                        <th>カテゴリー</th>
                        <th>タイトル</th>
                        <th>説明</th>
                        <th>作者</th>
                        <th>ダウンロード数</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($materials as $material)
                        <tr class="text-center border-b border-indigo-500 border-opacity-95 divide-x divide-solid divide-indigo-500 divide-opacity-30">
                            <td>
                                {{ $material->id }}
                            </td>
                            <td>
                                <a href="{{ route('material.show', $material) }}">
                                    <img class="object-contain p-1 h-full sm:h-24 mx-auto"
                                        src="{{ $material->image }}" loading="lazy">
                                </a>
                            </td>

                            <td>{{ Str::limit($material->categories->implode('name', ','), 20) }}</td>
                            <td>{{ Str::limit($material->title, 30) }}</td>
                            <td>{{ Str::limit($material->description, 20) }}</td>
                            <td>
                                {{ $material->user->name }}
                            </td>
                            <td>{{ $material->download }}</td>

                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
        {{ $materials->links() }}
    </div>
</div>
