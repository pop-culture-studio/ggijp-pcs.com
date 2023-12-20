<div>
    @if($files)
        <div class="text-white bg-indigo-500 px-3 py-1 rounded-t-lg">プレビュー</div>
        <div class="grid grid-cols-3 gap-3 bg-indigo-100 dark:bg-indigo-400 p-3 rounded-b-lg">
            @foreach($files as $name => $file)
                <figure class="hover:cursor-pointer hover:bg-white dark:hover:bg-indigo-600 hover:rounded-md"
                        wire:click="show('{{ $name }}')"
                        wire:key="{{ $name }}">
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
