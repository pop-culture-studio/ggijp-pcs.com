<div wire:init="zip">
    @if($files)
        <div class="grid grid-cols-2 gap-3">
            @foreach($files as $name => $file)
                <img src="{{ $file['image'] }}"
                     alt="{{ $name }}" title="{{ $name }}">
            @endforeach
        </div>
    @endif
</div>
