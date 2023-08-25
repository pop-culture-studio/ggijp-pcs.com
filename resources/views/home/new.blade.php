<x-h2 class="mt-20 mb-10" id="new">新しい素材</x-h2>

<div class="my-6 mx-3 flex flex-wrap gap-4 justify-center">
    @foreach ($new_materials as $material)
        <livewire:material.item :material="$material" lazy></livewire:material.item>
    @endforeach
</div>
