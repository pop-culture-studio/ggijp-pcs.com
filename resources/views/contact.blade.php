<x-main-layout>
    <x-slot name="title">
        {{ __('リクエスト・お問い合わせ') }}
    </x-slot>

    <div class="py-6">
        <div class="px-2 sm:px-6 lg:px-8">
            <h1 class="text-4xl mt-10 text-center">{{ __('リクエスト・お問い合わせ') }}</h1>

            <div class="py-3 sm:max-w-xl mx-auto">
                <p>ご要望やご質問、個人的なご依頼、サイトやデータについてお気づきの点などありましたらこちらよりご連絡ください。 素材のご利用については事前に
                    ｢<a href="{{ route('terms.show') }}" class="text-blue-500 underline">利用規約</a>｣
                    ｢<a href="{{ route('faq') }}" class="text-blue-500 underline">よくある質問</a>｣をご確認の上お願いします。</p>

                <p class="mt-3">その他にも｢こんなイラストが欲しい｣、｢こんな背景・ボイス・3D素材｣など、各素材のリクエストを募集しています。
                    よりイメージに近いものを提供するため、できるだけ具体的にお書きいただけると幸いです。</p>

                <p class="mt-3">ご利用報告などもいただけると制作の励みになります。 お気軽にご連絡ください。</p>
            </div>

            <livewire:contact-form/>

        </div>
    </div>
</x-main-layout>
