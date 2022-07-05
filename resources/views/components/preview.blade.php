@props(['material'])

<div class="flex justify-center rounded-lg sm:p-5">
    @if (str_contains(Storage::mimeType($material->file), 'audio'))
        <audio controls src="{{ Storage::temporaryUrl($material->file, now()->addHours(12)) }}">
            このブラウザでは表示できません。
        </audio>
    @elseif (str_contains(Storage::mimeType($material->file), 'video'))
        <video controls class="w-auto">
            <source src="{{ Storage::temporaryUrl($material->file, now()->addHours(12)) }}"
                type="{{ Storage::mimeType($material->file) }}">
            このブラウザでは表示できません。
        </video>
    @elseif (str_contains(Storage::mimeType($material->file), 'image'))
        <img class="object-contain h-full w-auto" src="{{ Storage::temporaryUrl($material->file, now()->addHours(12)) }}" title="{{ $material->title }}"
             alt="{{ $material->title }}">
    @else
        <img class="object-contain h-full w-auto" src="{{ $material->image }}" title="{{ $material->title }}"
            alt="{{ $material->title }}">
    @endif
</div>
