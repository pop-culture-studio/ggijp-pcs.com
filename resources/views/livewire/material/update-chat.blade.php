<div>
    <x-button wire:click="update">
        {{ __('説明を再生成') }}
    </x-button>

    @if (session()->has('message'))
        <div class="text-gray-500">
            {{ session('message') }}
        </div>
    @endif
</div>
