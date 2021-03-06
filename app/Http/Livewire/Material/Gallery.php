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

    public bool $showModal;
    public string $modalImage;
    public string $modalName;

    public function zip(): void
    {
        if (! Storage::disk('local')->put('tmp/zip/'.$this->material->file, Storage::get($this->material->file))) {
            return;
        }

        $zip = app(ZipArchive::class);

        if (! $zip->open(Storage::disk('local')->path('tmp/zip/'.$this->material->file))) {
            return;
        }

        foreach (range(0, $zip->count() - 1) as $index) {
            $name = $zip->getNameIndex($index, ZipArchive::FL_ENC_RAW);
            $enc = mb_detect_encoding($name);
            if (empty($enc)) {
                $enc = 'CP932';
            }
            $name = mb_convert_encoding($name, 'UTF-8', $enc);

            if (str_contains($name, '__MACOSX/')) {
                continue;
            }

            //Live2Dのテクスチャは除く
            if (str_contains($name, 'texture_00.png')) {
                continue;
            }

            $name = basename($name);

            $data = $zip->getFromIndex($index);

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

    public function showModal($name)
    {
        $this->modalName = $name;
        $this->modalImage = $this->files[$name]['image'];
        $this->showModal = true;
    }

    public function render()
    {
        return view('livewire.material.gallery');
    }
}
