<h2 class="text-3xl mb-5">ファイルアップロード</h2>

<form action="{{ route('material.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <input type="file" name="file" required />

    <x-jet-button>
        {{ __('アップロード') }}
    </x-jet-button>

    <x-jet-input-error for="file" />

</form>
