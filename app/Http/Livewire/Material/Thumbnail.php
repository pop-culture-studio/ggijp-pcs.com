<?php

namespace App\Http\Livewire\Material;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithFileUploads;

class Thumbnail extends Component
{
    use WithFileUploads;
    use AuthorizesRequests;

    public $material;

    public $thumbnail;

    protected $rules = [
        'thumbnail' => ['nullable', 'max:1024', 'image', 'mimes:jpg,jpeg,gif,png,webp'],
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function update()
    {
        $this->authorize('update', $this->material);

        $this->validate();

        $thumbnail_path = 'thumbnails/'.today()->year.'/'.today()->month;
        $thumbnail = $this->thumbnail?->store($thumbnail_path);

        $this->material->fill([
            'thumbnail' => $thumbnail,
        ])->save();

        $this->reset('thumbnail');
    }

    public function delete()
    {
        $this->material->fill([
            'thumbnail' => null,
        ])->save();
    }

    public function render()
    {
        return view('livewire.material.thumbnail');
    }
}
