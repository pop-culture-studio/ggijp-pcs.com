<x-h2 class="mt-20 mb-10" id="popular">人気な素材</x-h2>

<div class="my-6 mx-3 flex flex-wrap gap-4 justify-center">
    @foreach ($popular_materials as $material)
        <livewire:material.item :material="$material" lazy></livewire:material.item>
    @endforeach
</div>
