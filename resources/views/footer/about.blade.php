<div>
    <ul role="list" class="flex justify-around mx-auto py-6 sm:px-20 text-gray-500">
        <li>
            <a href="{{ route('about') }}" class="hover:underline">{{ __('未来図倉庫について') }}</a>
        </li>
        <li>
            <a href="{{ route('terms.show') }}" class="hover:underline">{{ __('利用規約') }}</a>
        </li>
        <li>
            <a href="{{ route('faq') }}" class="hover:underline">{{ __('よくある質問') }}</a>
        </li>
        <li>
            <a href="{{ route('contact') }}" class="hover:underline">{{ __('お問い合わせ') }}</a>
        </li>
        <li>
            <a href="{{ route('policy.show') }}" class="hover:underline">{{ __('プライバシーポリシー') }}</a>
        </li>
    </ul>
</div>
