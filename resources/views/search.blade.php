<div class="mx-auto p-6 sm:w-1/2">
    <form action="{{ route('material.index') }}" method="get" class="flex">
        <x-jet-label for="q" value="{{ __('検索') }}" class="hidden"/>
        <x-jet-input name="q" type="search" class="flex-auto rounded-full rounded-r-none"
                     value="{{ request('q') }}" placeholder="{{ __('キーワード検索') }}"/>
        <x-jet-button class="rounded-full rounded-l-none" title="素材のタイトル・説明・作者名・カテゴリーから検索"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg></x-jet-button>
    </form>
</div>
