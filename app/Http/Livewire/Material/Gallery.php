<?php

namespace App\Http\Livewire\Material;

use App\Models\Material;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use ZipArchive;

class Gallery extends Component
{
    public Material $material;

    public array $files;

    public function mount()
    {
        $file = Storage::get($this->material->file);
        if (! Storage::disk('local')->put('tmp/zip/'.$this->material->file, $file)) {
            return;
        }

        $zip = new ZipArchive();
        if (! $zip->open(Storage::disk('local')->path('tmp/zip/'.$this->material->file))) {
            return;
        }

        $count = $zip->count();

        for ($i = 0; $i < $count; $i++) {
            $name = $zip->getNameIndex($i);

            if (str_contains($name, '/')) {
                continue;
            }

            $data = $zip->getFromIndex($i);

            if (! Storage::disk('local')->put('tmp/img/'.$name, $data)) {
                continue;
            }

            if (str_contains($mime = Storage::disk('local')->mimeType('tmp/img/'.$name), 'image/')) {
                $this->files[$name] = [
                    'name' => $name,
                    'data' => base64_encode($data),
                    'mime' => $mime,
                ];
            }
        }
    }

    public function render()
    {
        return view('livewire.material.gallery');
    }
}
