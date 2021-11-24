<?php

namespace App\Http\Livewire\Material\Thumbnail;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;
    use AuthorizesRequests;

    public $material;

    public $thumbnail;

    public function updatedThumbnail()
    {
        $this->validate([
            'thumbnail' => ['nullable', 'max:1024', 'image', 'mimes:jpg,jpeg,png'],
        ]);
    }

    public function update()
    {
        $this->authorize('update', $this->material);

        $this->validate([
            'thumbnail' => ['nullable', 'max:1024', 'image', 'mimes:jpg,jpeg,png'],
        ]);

        $thumbnail_path = 'thumbnails/'.today()->year.'/'.today()->month;
        $thumbnail = $this->thumbnail?->store($thumbnail_path);

        $this->material->fill([
            'thumbnail' => $thumbnail,
        ])->save();

        $this->reset('thumbnail');
    }

    function delete()
    {
        $this->material->fill([
            'thumbnail' => null,
        ])->save();
    }

    public function render()
    {
        return view('livewire.material.thumbnail.edit');
    }
}
