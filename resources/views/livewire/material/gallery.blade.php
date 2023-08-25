<div wire:init="zip">
    @if($files)
        <div class="grid grid-cols-3 gap-3 bg-indigo-100 dark:bg-indigo-600 p-3 rounded-lg">
            @foreach($files as $name => $file)
                <figure class="hover:cursor-pointer" wire:click="showModal('{{ $name }}')">
                    <img src="{{ $file['image'] }}"
                         loading="lazy"
                         alt="{{ $name }}"
                         title="{{ $name }}">
                    <figcaption class="text-center text-sm">{{ $name }}</figcaption>
                </figure>
            @endforeach
        </div>

        @if($showModal)
            <x-modal wire:model.live="showModal" maxWidth="xl" ring="ring-{{ $material->categoryColor }}">
                <figure>
                    <img src="{{ $modalImage }}"
                         loading="lazy"
                         alt="{{ $modalName }}"
                         title="{{ $modalName }}">
                    <figcaption class="text-center text-lg">{{ $modalName }}</figcaption>
                </figure>
            </x-modal>
        @endif
    @endif
</div>
