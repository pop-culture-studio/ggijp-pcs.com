<?php

namespace App\Http\Livewire\Material;

use App\Models\Material;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use ZipArchive;

class Gallery extends Component
{
    public Material $material;

    public array $files = [];

    public function mount()
    {
        //rescue(fn () => $this->zip());
    }

    public function zip(): void
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
            $name = $zip->getNameIndex($i, ZipArchive::FL_ENC_RAW);
            $name = mb_convert_encoding($name, 'UTF-8', 'CP932');
            $name = basename($name);

            if (str_contains($name, '__MACOSX/')) {
                continue;
            }

            $data = $zip->getFromIndex($i);

            $random_path = 'tmp/img/'.Str::random();

            if (! Storage::put($random_path, $data)) {
                continue;
            }

            if (str_contains(Storage::mimeType($random_path), 'image/')) {
                $this->files[$name] = [
                    'image' => Storage::temporaryUrl($random_path, now()->addHour()),
                ];
            }
        }

        $zip->close();
    }

    public function render()
    {
        return view('livewire.material.gallery');
    }
}
