<x-h2 class="mt-20 mb-10" id="new">新しい素材</x-h2>

<div class="my-6 mx-3 flex flex-wrap gap-4">
    @foreach ($new_materials as $material)
        <x-item :material="$material" :image="$material->image" :name="$material->title"></x-item>
    @endforeach
</div>
