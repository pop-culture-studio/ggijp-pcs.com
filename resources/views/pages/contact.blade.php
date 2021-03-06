<x-main-layout>
    <x-slot name="title">
        {{ __('お問い合わせ') }}
    </x-slot>

    <div class="py-6">
        <div class="px-2 sm:px-6 lg:px-8">
            <h1 class="text-4xl mt-10 text-center">{{ __('お問い合わせ') }}</h1>

            <div class="py-3 text-center sm:max-w-xl mx-auto">ご要望やご質問、個人的なご依頼、サイトやデータについてお気づきの点などありましたらこちらよりご連絡ください。
                素材のご利用については事前に｢<a href="{{ route('terms.show') }}" class="text-indigo-500">利用規約</a>｣｢<a href="{{ route('faq') }}" class="text-indigo-500">よくある質問</a>｣をご確認の上お願いします。
                お返事不要の場合はメッセージフォームからもお送りいただけます。
            </div>

            <livewire:contact-form/>

        </div>
    </div>
</x-main-layout>
