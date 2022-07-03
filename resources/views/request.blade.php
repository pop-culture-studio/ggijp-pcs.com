<x-main-layout>
    <x-slot name="title">
        {{ __('リクエスト･メッセージ') }}
    </x-slot>

    <div class="py-6">
        <div class="px-2 sm:px-6 lg:px-8">
            <h1 class="text-4xl mt-10 text-center">{{ __('リクエスト･メッセージ') }}</h1>

            <div class="py-3 text-center sm:max-w-xl mx-auto">｢こんなイラストが欲しい｣、｢こんな背景・ボイス・3D素材｣など、各素材のリクエストを募集しています。
                よりイメージに近いものを提供するため、できるだけ具体的にお書きいただけると幸いです。
                ご利用報告などもいただけると制作の励みになります。
                お気軽にご連絡ください。
            </div>

            <livewire:request-form/>

        </div>
    </div>
</x-main-layout>
