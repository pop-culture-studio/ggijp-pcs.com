<?php

namespace App\Livewire\Material;

use App\Models\Material;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class Thumbnail extends Component
{
    use WithFileUploads;
    use AuthorizesRequests;

    public Material $material;

    #[Rule('nullable', 'max:2048', 'image', 'mimes:jpg,jpeg,gif,png,webp')]
    public string|TemporaryUploadedFile|null $thumbnail = null;

    /**
     * @throws ValidationException
     */
    public function updated($propertyName): void
    {
        $this->validateOnly($propertyName);
    }

    /**
     * @throws AuthorizationException
     */
    public function update(): void
    {
        $this->authorize('update', $this->material);

        $this->validate();

        $thumbnail_path = 'thumbnails/'.today()->year.'/'.today()->month;
        $thumbnail = $this->thumbnail?->store($thumbnail_path);

        $this->material->forceFill([
            'thumbnail' => $thumbnail,
        ])->save();

        $this->reset('thumbnail');
    }

    public function delete(): void
    {
        $this->material->forceFill([
            'thumbnail' => null,
        ])->save();
    }
}
