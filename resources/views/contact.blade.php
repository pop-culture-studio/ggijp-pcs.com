<x-main-layout>
    <x-slot name="title">
        {{ __('お問い合わせ') }}
    </x-slot>

    <div class="py-6">
        <div class="sm:px-6 lg:px-8">
            <h1 class="text-4xl mt-10">{{ __('お問い合わせ') }}</h1>

            <div class="py-3">ご要望やご質問、個人的なご依頼、サイトやデータについてお気づきの点などありましたらこちらよりご連絡ください。
                素材のご利用については事前に｢利用規約｣｢よくある質問｣をご確認の上お願いします。
                お返事不要の場合はメッセージフォームからもお送りいただけます。
            </div>

            <livewire:contact-form/>

        </div>
    </div>
</x-main-layout>
