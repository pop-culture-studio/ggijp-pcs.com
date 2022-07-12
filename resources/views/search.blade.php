<div class="mx-auto p-6 sm:w-1/2">
    <form action="{{ route('material.index') }}" method="get" class="flex">
        <x-jet-label for="q" value="{{ __('検索') }}" class="hidden"/>
        <x-jet-input name="q" type="search" class="flex-auto rounded-full rounded-r-none"
                     value="{{ request('q') }}" placeholder="{{ __('キーワード検索') }}"/>
        <x-jet-button class="rounded-full rounded-l-none" title="素材のタイトル・説明・作者名・カテゴリーから検索"><x-icon.search/></x-jet-button>
    </form>
</div>
