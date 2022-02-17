<x-app-layout>
    <x-slot name="title">
        チーム素材
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('未来図倉庫チームの素材一覧') }}
        </h2>
    </x-slot>

    @include('dashboard.materials.list')

</x-app-layout>
