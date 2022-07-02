<h2 class="text-3xl text-center text-gray-500" id="new">新しい素材</h2>

<div class="my-6 mx-3 flex flex-wrap gap-4">
    @foreach ($new_materials as $material)
        <x-item :material="$material" :image="$material->image" :name="$material->title"></x-item>
    @endforeach
</div>

<a href="{{ route('material.index') }}"
    class="w-1/3 mx-auto block text-center text-xl p-3 m-3 text-white bg-gray-400 hover:bg-gray-300 rounded-full">
    すべての素材を見る
</a>
