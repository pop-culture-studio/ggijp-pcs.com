<?php

namespace App\Livewire\Material;

use App\Models\Material;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\FileUploadConfiguration;
use ZipArchive;

class Gallery extends Component
{
    public Material $material;

    public array $files = [];

    public bool $showModal;

    public string $modalImage;

    public string $modalName;

    /**
     * zip内のファイルが画像なら表示.
     */
    public function zip(): void
    {
        $tmp = FileUploadConfiguration::directory();

        if (! Storage::disk('local')->put($tmp.'/zip/'.$this->material->file, Storage::get($this->material->file))) {
            return;
        }

        $zip = app(ZipArchive::class);

        if (! $zip->open(Storage::disk('local')->path($tmp.'/zip/'.$this->material->file))) {
            return;
        }

        foreach (range(0, $zip->count() - 1) as $index) {
            $name = $zip->getNameIndex($index, ZipArchive::FL_ENC_RAW);
            $name = $this->encoding($name);

            if ($this->reject($name)) {
                continue;
            }

            $name = basename($name);

            $data = $zip->getFromIndex($index);

            $random_path = $tmp.'/img/'.Str::random();

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

    /**
     * ファイル名の文字コードをUTF-8に揃える.
     */
    private function encoding(string $name): string
    {
        $enc = mb_detect_encoding($name);

        if (empty($enc)) {
            $enc = 'CP932';
        }

        return mb_convert_encoding($name, 'UTF-8', $enc);
    }

    /**
     * 除外するファイル名.
     */
    private function reject(string $name): bool
    {
        return Str::contains($name, [
            '__MACOSX/', // MacのFinderで作られたzipの__MACOSX内
            'texture_00.png', // Live2Dのテクスチャ
        ]);
    }

    public function show($name): void
    {
        $this->modalName = $name;
        $this->modalImage = $this->files[$name]['image'];
        $this->showModal = true;
    }
}
