<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <h2 class="text-3xl mb-5">ファイル情報の編集</h2>

                <form action="{{ route('material.update', $material) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <x-jet-label for="file" value="{{ __('ファイルを変更するには削除してアップロードし直してください。') }}" />

                    <img class="object-contain h-full sm:h-56" src="{{ route('file', $material) }}"
                        alt="{{ $material->title }}" title="{{ $material->title }}" loading="lazy">

                    <div class="my-2">
                        <x-jet-label for="title" value="{{ __('タイトル') }}" />
                        <x-jet-input name="title" value="{{ $material->title }}" type="text" class="mt-1 block w-1/2"
                            required />
                        <x-jet-input-error for="title" class="mt-2" />
                    </div>

                    <div class="my-2">
                        <x-jet-label for="description" value="{{ __('説明') }}" />
                        <textarea name="description" rows="4" cols="40"
                            class="mt-1 block w-1/2 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">{{ $material->description }}</textarea>
                        <x-jet-input-error for="description" class="mt-2" />
                    </div>

                    <x-jet-button>
                        {{ __('更新') }}
                    </x-jet-button>

                </form>


            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white overflow-hidden shadow-xl sm:rounded-lg border-2 border-red-500">
                <h2 class="text-3xl mb-5">削除</h2>

                <form action="{{ route('material.destroy', $material) }}" method="post">
                    @csrf
                    @method('DELETE')

                    <x-jet-button class="bg-red-500 hover:bg-red-400">
                        {{ __('今すぐ削除') }}
                    </x-jet-button>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>
