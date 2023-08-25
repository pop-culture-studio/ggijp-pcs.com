<div>
    <form wire:submit="update">

        @if (!empty($material->thumbnail))
            <img class="object-contain h-full sm:h-56"
                 src="{{ Storage::temporaryUrl($material->thumbnail, now()->addMinutes(60)) }}"
                 alt="{{ $material->title }}" title="{{ $material->title }}" loading="lazy">
        @endif

        <x-label for="file" value="{{ 'ファイル（2MBまで）' }}"/>

        <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true, progress = 0"
             x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false"
             x-on:livewire-upload-progress="progress = $event.detail.progress">

            <input type="file" accept="image/*" class="file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border file:border-solid file:border-indigo-500 file:bg-indigo-50 file:text-indigo-700
      hover:file:bg-indigo-100" wire:model.live="thumbnail"/>

            <div class="p-3">

                <div x-show="isUploading">
                    <div class="text-indigo-500 font-bold">アップロードしています...</div>

                    <progress max="100" x-bind:value="progress"></progress>
                </div>

                <div x-show="!isUploading">
                    @if (!$errors->has('thumbnail') && $thumbnail && str_contains($thumbnail->getMimeType(), 'image'))
                        <img class="object-contain h-full sm:h-56" src="{{ $thumbnail->temporaryUrl() }}">
                    @endif
                </div>

                <x-input-error for="thumbnail"/>
            </div>
        </div>


        <x-button class="mt-2">
            {{ __('登録') }}
        </x-button>

    </form>

    <form wire:submit="delete">
        <x-danger-button class="mt-10" type="submit">
            {{ __('サムネイル画像を削除') }}
        </x-danger-button>
    </form>
</div>
