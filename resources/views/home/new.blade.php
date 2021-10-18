<h2 class="text-3xl">新着</h2>

<div class="my-6 flex flex-wrap gap-4">
    @foreach ($materials as $material)
        <x-new-item :image="route('file', $material)" :name="$material->title"></x-new-item>
    @endforeach
</div>
