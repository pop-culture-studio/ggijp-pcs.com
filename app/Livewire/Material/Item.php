<?php

namespace App\Livewire\Material;

use App\Models\Material;
use Illuminate\View\View;
use Livewire\Component;

class Item extends Component
{
    public bool $ready = false;

    public Material $material;

    public string $image;

    public function onReady(): void
    {
        $this->ready = true;

        $this->image = $this->material->image;
    }

    public function mount(): void
    {
        //$this->material->refresh();
        //$this->image = $this->material->image;
    }

    public function render(): View
    {
        return view('livewire.material.item');
    }
}
