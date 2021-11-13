<form wire:submit.prevent="create">

    <x-jet-label for="file"
        value="{{ 'ファイル（必須。' . config('pcs.max_upload') . 'MB以下。対応フォーマット：' . config('pcs.mimes') . '）' }}" />

    <input type="file" wire:model="file" required />

    <div class="p-3">
        <div wire:loading wire:target="file" class="text-indigo-500 font-bold">アップロードしています...</div>

        @if ($file && str_contains($file->getMimeType(), 'image'))
            <img class="object-contain h-full sm:h-56" src="{{ $file->temporaryUrl() }}">
        @endif

        <x-jet-input-error for="file" />
    </div>

    <div class="my-2">
        <x-jet-label for="cat" value="{{ __('カテゴリー（必須。複数設定するには,で区切ってください。）') }}" />
        <x-jet-input name="cat" type="text" class="mt-1 block w-full sm:w-1/2" required wire:model="cat" />
        <x-jet-input-error for="cat" class="mt-2" />

        <div class="my-2 text-md">基本カテゴリー
            @foreach (config('pcs.category') as $cat)
                {{ Arr::get($cat, 'title') }}@if (!$loop->last),@endif
            @endforeach
        </div>

    </div>

    <div class="my-2">
        <x-jet-label for="title" value="{{ __('タイトル') }}" />
        <x-jet-input name="title" type="text" class="mt-1 block w-full sm:w-1/2" wire:model="title" />
        <x-jet-input-error for="title" class="mt-2" />
    </div>

    <div class="my-2">
        <x-jet-label for="description" value="{{ __('説明') }}" />
        <textarea name="description" rows="4" cols="40" wire:model="description"
            class="mt-1 block w-full sm:w-1/2 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"></textarea>
        <x-jet-input-error for="description" class="mt-2" />
    </div>

    <x-jet-button class="mt-2">
        {{ __('アップロード') }}
    </x-jet-button>

</form>
