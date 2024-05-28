<x-app-layout>
    <x-slot name="title">
        ダッシュボード
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white dark:bg-black overflow-hidden shadow-xl sm:rounded-lg">
                @can('create', App\Models\Material::class)
                    @include('dashboard.create')
                @else
                    素材のアップロードは未来図倉庫チームメンバーのみ可能です。
                @endcan
            </div>
        </div>
    </div>

    @include('dashboard.list')

</x-app-layout>
