<?php

namespace App\Livewire\Material;

use App\Models\Material;
use Illuminate\Support\Facades\URL;
use Livewire\Component;

class Download extends Component
{
    public Material $material;

    public function download(): void
    {
        $this->redirect(URL::temporarySignedRoute('download', now()->addHours(12), $this->material));
    }
}
