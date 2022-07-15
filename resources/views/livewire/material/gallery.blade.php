<div wire:init="zip">
    @if($files)
        <div class="grid grid-cols-3 gap-3 bg-indigo-100 dark:bg-indigo-600 p-3 rounded-lg">
            @foreach($files as $name => $file)
                <figure class="pcs:scale-up-image">
                    <img src="{{ $file['image'] }}"
                         loading="lazy"
                         alt="{{ $name }}"
                         title="{{ $name }}">
                    <figcaption class="text-center">{{ $name }}</figcaption>
                </figure>

            @endforeach
        </div>
    @endif
</div>
