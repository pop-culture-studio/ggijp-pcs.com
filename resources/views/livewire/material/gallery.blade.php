<div wire:init="zip">
    @if($files)
        <div class="grid grid-cols-2 gap-3">
            @foreach($files as $name => $file)
                <img src="data:{!! $file['mime'] !!};base64,{!! $file['data'] !!}"
                     alt="{{ $name }}" title="{{ $name }}">
            @endforeach
        </div>
    @endif
</div>
