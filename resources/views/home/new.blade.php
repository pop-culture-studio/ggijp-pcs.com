<h2 class="text-3xl">新着</h2>

<div class="my-6 flex flex-wrap gap-4">
    @foreach ($materials as $material)
        <x-new-item :material="$material" :image="route('file', $material)" :name="$material->title"></x-new-item>
    @endforeach
</div>

<a href="{{ route('material.index') }}"
    class="block text-center text-xl p-3 m-6 text-white bg-indigo-500 hover:bg-indigo-400 rounded-lg">
    すべての素材
</a>
