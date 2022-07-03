<div class="w-full sm:max-w-xl sm:mx-auto mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
    @if(session()->missing('mail_success'))

        <x-jet-validation-errors class="mb-4"/>

        <form wire:submit.prevent="sendmail">
            <div>
                <x-jet-label for="message" value="{{ __('メッセージ') }}" class="hidden"/>

                <textarea name="body"
                          wire:model.lazy="body"
                          class="w-full h-32 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                          required
                ></textarea>
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-jet-button class="ml-4">
                    {{ __('送信') }}
                </x-jet-button>
            </div>
        </form>

    @else
        {{ __('リスエクトありがとうございました。') }}
    @endif
</div>

