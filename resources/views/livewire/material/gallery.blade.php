<div wire:init="zip">
    @if($files)
        <div class="grid grid-cols-3 gap-3 bg-indigo-100 dark:bg-indigo-600 p-3 rounded-lg">
            @foreach($files as $name => $file)
                <img src="{{ $file['image'] }}"
                     loading="lazy"
                     alt="{{ $name }}"
                     title="{{ $name }}"
                     class="pcs:scale-up-image">
            @endforeach
        </div>
    @endif
</div>
