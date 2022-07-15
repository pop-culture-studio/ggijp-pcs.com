<div wire:init="zip">
    @if($files)
        <div class="grid grid-cols-3 gap-3">
            @foreach($files as $name => $file)
                <img src="{{ $file['image'] }}"
                     alt="{{ $name }}" title="{{ $name }}"
                class="pcs:scale-up-image">
            @endforeach
        </div>
    @endif
</div>
