<?php

namespace App\Livewire\Material;

use App\Models\Material;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Download extends Component
{
    public Material $material;

    public function download(): void
    {
        dispatch(fn () => Material::withoutTimestamps(fn () => $this->material->increment('download')));

        $this->redirect(
            Storage::temporaryUrl(
                $this->material->file,
                now()->addHour(),
                [
                    'ResponseContentType' => 'application/octet-stream',
                    'ResponseContentDisposition' => 'attachment; filename='.basename($this->material->file),
                ]
            )
        );
    }
}
