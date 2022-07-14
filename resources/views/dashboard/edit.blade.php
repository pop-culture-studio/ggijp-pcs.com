<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8">

            <h1 class="text-3xl"><a href="{{ route('material.show', $material) }}">{{ $material->title }}</a></h1>

            <div class="p-6 bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <h2 class="text-3xl mb-5">ファイル情報の編集</h2>

                <form action="{{ route('material.update', $material) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <x-jet-label for="file" value="{{ __('ファイルの差し替えはできません。ファイルを変更するには非公開にしてから別のファイルを新規アップロードし直してください。') }}"/>

                    <img class="object-contain h-full sm:h-56" src="{{ $material->image }}"
                         alt="{{ $material->title }}" title="{{ $material->title }}" loading="lazy">

                    <div class="my-2">
                        <x-jet-label for="cat" value="{{ __('カテゴリー（必須。複数設定するには「,」で区切ってください。）') }}"/>
                        <x-jet-input name="cat" type="text" value="{{ $material->categories->implode('name', ',') }}"
                                     class="mt-1 block w-full sm:w-1/2" required/>
                        <x-jet-input-error for="cat" class="mt-2"/>

                        <div class="my-2 text-md">基本カテゴリー
                            <span class="font-bold">
                            @foreach (config('pcs.category') as $cat)
                                {{ Arr::get($cat, 'title') }}@if (!$loop->last),@endif
                            @endforeach
                            </span>
                        </div>
                    </div>

                    <div class="my-2">
                        <x-jet-label for="title" value="{{ __('タイトル（必須）') }}"/>
                        <x-jet-input name="title" value="{{ $material->title }}" type="text"
                                     class="mt-1 block w-full sm:w-1/2" required/>
                        <x-jet-input-error for="title" class="mt-2"/>
                    </div>

                    <div class="my-2">
                        <x-jet-label for="description" value="{{ __('説明') }}"/>
                        <textarea name="description" rows="4" cols="40"
                                  class="mt-1 block w-full sm:w-1/2 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">{{ $material->description }}</textarea>
                        <x-jet-input-error for="description" class="mt-2"/>
                    </div>

                    <x-jet-button class="mt-2">
                        {{ __('更新') }}
                    </x-jet-button>

                </form>

                <details class="mt-3 p-3 bg-indigo-100 rounded-md">
                    <summary>ヘルプ</summary>
                    <ul class="list-inside list-disc">
                        <li>
                            カテゴリーの順番を変更したり左上に表示するカテゴリーを変更するには：一番目に表示させたいカテゴリーだけ残して他を削除して更新後、再度他のカテゴリーを入力して更新すれば入力した順に表示される。
                        </li>
                    </ul>
                </details>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8">
            <div class="p-6 bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <h2 class="text-3xl mb-3">サムネイル画像の登録</h2>

                <div class="mb-5">画像以外の素材にサムネイル用の画像を設定したい時はここで登録してください。</div>

                <livewire:material.thumbnail :material="$material"/>

            </div>
        </div>
    </div>

    @can('delete', $material)
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-6 bg-white overflow-hidden shadow-xl sm:rounded-lg border-2 border-red-500">
                    <details>
                        <summary>非公開</summary>
                        <h2 class="text-3xl mb-2">ファイルを非公開にする</h2>

                        <div class="text-red-500 mb-5">公開に戻せません。どうしても戻したい場合はスタッフに連絡してください。</div>

                        <form action="{{ route('material.destroy', $material) }}" method="post">
                            @csrf
                            @method('DELETE')

                            <div class="flex items-center mb-3">
                                <x-jet-checkbox name="forceDelete"/>

                                <div class="ml-2 text-red-500">
                                    復元できないように完全に削除
                                </div>
                            </div>

                            <x-jet-danger-button type="submit">
                                {{ __('今すぐ非公開') }}
                            </x-jet-danger-button>

                        </form>
                    </details>
                </div>
            </div>
        </div>
    @endcan
</x-app-layout>
