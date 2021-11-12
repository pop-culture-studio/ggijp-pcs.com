<h2 class="text-3xl mb-5">アップロード</h2>

<form action="{{ route('material.store') }}" method="post" enctype="multipart/form-data">
    @csrf

    <x-jet-label for="file" value="{{ __('ファイル（必須。10MB以下。対応フォーマット：jpg,png）') }}" />

    <input type="file" name="file" required />

    <x-jet-input-error for="file" />

    <div class="my-2">
        <x-jet-label for="cat" value="{{ __('カテゴリー（必須。複数設定するには,で区切ってください。）') }}" />
        <x-jet-input name="cat" type="text" class="mt-1 block w-1/2" required />
        <x-jet-input-error for="cat" class="mt-2" />
    </div>

    <div class="my-2">
        <x-jet-label for="title" value="{{ __('タイトル') }}" />
        <x-jet-input name="title" type="text" class="mt-1 block w-1/2" />
        <x-jet-input-error for="title" class="mt-2" />
    </div>

    <div class="my-2">
        <x-jet-label for="description" value="{{ __('説明') }}" />
        <textarea name="description" rows="4" cols="40"
            class="mt-1 block w-1/2 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"></textarea>
        <x-jet-input-error for="description" class="mt-2" />
    </div>

    <x-jet-button class="mt-2">
        {{ __('アップロード') }}
    </x-jet-button>



</form>
