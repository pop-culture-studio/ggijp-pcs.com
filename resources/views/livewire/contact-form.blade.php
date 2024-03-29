<div class="w-full sm:max-w-xl sm:mx-auto mt-6 px-6 py-4 bg-white dark:bg-gray-300 shadow-md overflow-hidden sm:rounded-lg"
     wire:init="ready">
    @if(session()->missing('mail_success'))

        <x-validation-errors class="mb-4"/>

        <form wire:submit="sendmail">
            <div>
                <x-label for="name" value="{{ __('お名前') }}"/>
                <x-input id="name" class="block mt-1 w-full " type="text" name="name" wire:model.blur="name" required
                             autofocus autocomplete="name"/>
            </div>

            <div class="mt-4">
                <x-label for="email" value="{{ __('Email') }}"/>
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" wire:model.blur="email"
                             required/>
            </div>

            <div class="mt-4">
                <x-label for="message" value="{{ __('メッセージ') }}"/>

                <textarea name="body"
                          wire:model.blur="body"
                          class="text-black bg-white w-full h-32 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                          required
                ></textarea>
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-4">
                    {{ __('送信') }}
                </x-button>
            </div>
        </form>

    @else
        {{ __('お問い合わせありがとうございました。返信をお待ちください。') }}
    @endif
</div>

