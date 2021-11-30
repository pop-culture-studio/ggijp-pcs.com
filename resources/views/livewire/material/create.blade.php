<form wire:submit.prevent="create">

    <x-jet-label for="file"
                 value="{{ 'ファイル（必須。' . config('pcs.max_upload') . 'MB以下。）' }}"/>

    <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true, progress = 0"
         x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false"
         x-on:livewire-upload-progress="progress = $event.detail.progress">

        <input type="file" wire:model="file" required/>

        <div class="p-3">

            <div x-show="isUploading">
                <div class="text-indigo-500 font-bold">アップロードしています...</div>

                <progress max="100" x-bind:value="progress"></progress>
            </div>

            <div x-show="!isUploading">
                @if ($file)
                    @if (str_contains($file->getMimeType(), 'image'))
                        <img class="object-contain h-full sm:h-56" src="{{ $file->temporaryUrl() }}">
                    @elseif (str_contains($file->getMimeType(), 'audio'))
                        <audio controls src="{{ $file->temporaryUrl() }}">
                            このブラウザでは表示できません。
                        </audio>
                    @elseif (str_contains($file->getMimeType(), 'video'))
                        <video controls width="250">
                            <source src="{{ $file->temporaryUrl() }}" type="{{ $file->getMimeType() }}">
                            このブラウザでは表示できません。
                        </video>
                    @else
                        <div class="text-indigo-500 font-bold">アップロードしました。このファイルはプレビューできません。</div>
                    @endif
                @endif
            </div>

            <x-jet-input-error for="file"/>
        </div>
    </div>

    <div class="my-2">
        <x-jet-label for="cat" value="{{ __('カテゴリー（必須。複数設定するには,で区切ってください。）') }}"/>
        <x-jet-input name="cat" type="text" class="mt-1 block w-full sm:w-1/2" required wire:model="cat"/>
        <x-jet-input-error for="cat" class="mt-2"/>

        <div class="my-2 text-md">基本カテゴリー
            @foreach (config('pcs.category') as $cat)
                {{ Arr::get($cat, 'title') }}@if (!$loop->last),@endif
            @endforeach
        </div>

    </div>

    <div class="my-2">
        <x-jet-label for="title" value="{{ __('タイトル（省略時はファイル名）') }}"/>
        <x-jet-input name="title" type="text" class="mt-1 block w-full sm:w-1/2" wire:model="title"/>
        <x-jet-input-error for="title" class="mt-2"/>
    </div>

    <div class="my-2">
        <x-jet-label for="description" value="{{ __('説明') }}"/>
        <textarea name="description" rows="4" cols="40" wire:model="description"
                  class="mt-1 block w-full sm:w-1/2 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"></textarea>
        <x-jet-input-error for="description" class="mt-2"/>
    </div>

    <x-jet-button class="mt-2">
        {{ __('アップロード') }}
    </x-jet-button>

    <details class="mt-3 p-3 bg-indigo-100 rounded-md">
        <summary>ヘルプ</summary>
        <ul class="list-inside list-disc">
            <li>どんなファイルでもアップロードできますがマイナーなフォーマットは正常にダウンロードできない場合があります。そんな時はzipにしてからアップロードしてください。</li>
            <li>カテゴリーはなんでも自由に追加できます。カテゴリーは正確に入力しないと別カテゴリーで登録されます。基本カテゴリーはコピペでの入力を推奨。</li>
            <li>サムネイル用の画像を登録するには先に素材ファイルをアップロードしてから編集画面でサムネイルを登録してください。</li>
            <li>ダウンロード時のファイル名はアップロードしたファイルとは違うランダムなので元のファイル名を残したい場合はタイトルや説明に書いてください。</li>
        </ul>
    </details>
</form>
