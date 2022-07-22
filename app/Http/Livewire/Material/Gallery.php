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

        $count = $zip->count() - 1;

        foreach (range(0, $count) as $index) {
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

    public function render()
    {
        return view('livewire.material.gallery');
    }
}
