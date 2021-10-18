<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white overflow-hidden shadow-xl sm:rounded-lg">

                @include('material.create')
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <table class="table-auto w-full">
                    <thead>
                        <tr>
                            <th>ファイル</th>
                            <th>名前</th>
                            <th>説明</th>
                            <th>作成日</th>
                            <th>更新日</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($materials as $material)
                            <tr class="text-center">
                                <td>
                                    <img class="object-contain h-full sm:h-24 mx-auto" src="{{ route('file', $material) }}">
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

    {{-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <x-jet-welcome />
            </div>
        </div>
    </div> --}}
</x-app-layout>
