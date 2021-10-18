<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="p-6 bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <table class="table-auto w-full">
                <thead>
                    <tr>
                        <th></th>
                        <th>ファイル</th>
                        <th>名前</th>
                        <th>説明</th>
                        <th>作成日</th>
                        <th>更新日</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($materials as $material)
                        <tr class="text-center border-b border-indigo-500 border-opacity-50">
                            <td>
                                <form action="{{ route('material.edit', $material) }}">
                                    <x-jet-button>
                                        {{ __('編集') }}
                                    </x-jet-button>
                                </form>
                            </td>
                            <td>
                                <img class="object-contain p-1 h-full sm:h-24 mx-auto" src="{{ route('file', $material) }}" loading="lazy">
                            </td>

                            <td>{{ $material->title }}</td>
                            <td>{{ Str::limit($material->description, 20) }}</td>
                            <td>{{ $material->created_at }}</td>
                            <td>{{ $material->updated_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
        {{ $materials->links() }}
    </div>
</div>
