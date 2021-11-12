<h2 class="text-3xl">カテゴリー</h2>

{{-- <x-admin-message text="ここのカテゴリーは固定カテゴリーと季節ごとの特集カテゴリーなどを配置。" /> --}}

<div class="my-6 mx-3 grid grid-flow-row grid-cols-3 grid-rows-3 gap-4">
    <div class="w-auto"><img
            src="https://placehold.jp/f71b1b/ffffff/350x180.png?text={{ urlencode('クリスマス') }}"></div>
    <div class="w-auto"><img src="https://placehold.jp/f71b1b/ffffff/350x180.png?text={{ urlencode('正月') }}">
    </div>

    <div class="w-auto">
        <a href="{{ route('category.show', 10) }}" title="2Dモデル">
            <img src="{{ asset('images/cat/2d.png') }}">
        </a>
    </div>

    <div class="w-auto">
        <a href="{{ route('category.show', 11) }}" title="3Dモデル">
            <img src="{{ asset('images/cat/3d.png') }}">
        </a>
    </div>

    <div class="w-auto">
        <a href="{{ route('category.show', 12) }}" title="BGM">
            <img src="{{ asset('images/cat/BGM.png') }}">
        </a>
    </div>

    <div class="w-auto">
        <a href="{{ route('category.show', 13) }}" title="たべもの">
            <img src="{{ asset('images/cat/food.png') }}">
        </a>
    </div>

    <div class="w-auto">
        <a href="{{ route('category.show', 14) }}" title="のりもの">
            <img src="{{ asset('images/cat/vehicle.png') }}">
        </a>
    </div>

    <div class="w-auto">
        <a href="{{ route('category.show', 15) }}" title="音声素材">
            <img src="{{ asset('images/cat/voice.png') }}">
        </a>
    </div>

    <div class="w-auto">
        <a href="{{ route('category.show', 16) }}" title="行事・イベント">
            <img src="{{ asset('images/cat/event.png') }}">
        </a>
    </div>

    <div class="w-auto">
        <a href="{{ route('category.show', 17) }}" title="写真・背景">
            <img src="{{ asset('images/cat/photo.png') }}">
        </a>
    </div>

    <div class="w-auto">
        <a href="{{ route('category.show', 18) }}" title="職業・仕事">
            <img src="{{ asset('images/cat/work.png') }}">
        </a>
    </div>

    <div class="w-auto">
        <a href="{{ route('category.show', 19) }}" title="動物・植物">
            <img src="{{ asset('images/cat/animal.png') }}">
        </a>
    </div>

    {{-- <div class="w-auto"><img src="https://placehold.jp/9697a3/ffffff/350x180.png?text=%E3%82%AB%E3%83%86%E3%82%B4%E3%83%AA%E3%83%BC1"></div>
    <div class="w-auto"><img src="https://placehold.jp/9697a3/ffffff/350x180.png?text=%E3%82%AB%E3%83%86%E3%82%B4%E3%83%AA%E3%83%BC2"></div>
    <div class="w-auto"><img src="https://placehold.jp/9697a3/ffffff/350x180.png?text=%E3%82%AB%E3%83%86%E3%82%B4%E3%83%AA%E3%83%BC3"></div>
    <div class="w-auto"><img src="https://placehold.jp/9697a3/ffffff/350x180.png?text=%E3%82%AB%E3%83%86%E3%82%B4%E3%83%AA%E3%83%BC4"></div>
    <div class="w-auto"><img src="https://placehold.jp/9697a3/ffffff/350x180.png?text=%E3%82%AB%E3%83%86%E3%82%B4%E3%83%AA%E3%83%BC5"></div>
    <div class="w-auto"><img src="https://placehold.jp/9697a3/ffffff/350x180.png?text=%E3%82%AB%E3%83%86%E3%82%B4%E3%83%AA%E3%83%BC6"></div> --}}

</div>
