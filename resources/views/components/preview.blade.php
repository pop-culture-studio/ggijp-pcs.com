@props(['material'])

<div class="flex justify-center rounded-lg p-5">
    @if (str_contains(Storage::mimeType($material->file), 'audio'))
        <audio controls src="{{ Storage::temporaryUrl($material->file, now()->addMinutes(60)) }}">
            このブラウザでは表示できません。
        </audio>
    @elseif (str_contains(Storage::mimeType($material->file), 'video'))
        <video controls class="w-auto">
            <source src="{{ Storage::temporaryUrl($material->file, now()->addMinutes(60)) }}"
                type="{{ Storage::mimeType($material->file) }}">
            このブラウザでは表示できません。
        </video>
    @else
        <img class="object-contain h-full w-auto" src="{{ $material->image }}" title="{{ $material->title }}"
            alt="{{ $material->title }}">
    @endif
</div>
