<div>
    @if($files)
        <div class="grid grid-cols-2 gap-3">
            @foreach($files as $file)
                <img src="data:{{ $file['mime'] }};base64,{{ $file['data'] }}"
                     alt="{{ $file['name'] }}" title="{{ $file['name'] }}">
            @endforeach
        </div>
    @endif
</div>
