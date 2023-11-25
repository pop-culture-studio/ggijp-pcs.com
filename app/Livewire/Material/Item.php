<?php

namespace App\Livewire\Material;

use App\Models\Material;
use Livewire\Component;

class Item extends Component
{
    public Material $material;

    public string $image;

    public function onReady(): void
    {
        $this->image = $this->material->image;
    }
}
