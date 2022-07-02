<h2 class="text-2xl sm:text-4xl font-extrabold text-center text-gray-500" id="new">新しい素材</h2>

<div class="my-6 mx-3 flex flex-wrap gap-4">
    @foreach ($new_materials as $material)
        <x-item :material="$material" :image="$material->image" :name="$material->title"></x-item>
    @endforeach
</div>
