<?php

namespace App\Casts\Material;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Support\Facades\Storage;
use InvalidArgumentException;

/**
 * Material Image Cast.
 */
class Image implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return mixed
     */
    public function get($model, string $key, $value, array $attributes)
    {
        return rescue(fn () => $this->url($model), config('pcs.not_found_image'));
    }

    private function url($model): string
    {
        if (blank($model->file)) {
            throw new InvalidArgumentException();
        }

        if (app()->runningUnitTests()) {
            return Storage::url($model->file);
        }

        if (filled($model->thumbnail) && Storage::exists($model->thumbnail)) {
            return Storage::temporaryUrl(
                $model->thumbnail,
                now()->addHours(24),
                [
                    'ResponseCacheControl' => 'max-age=31536000',
                ]);
        }

        $mime = cache()->rememberForever('mimetype:'.$model->id, fn () => Storage::mimeType($model->file));

        if (str_contains($mime, 'image/')) {
            return Storage::temporaryUrl(
                $model->file,
                now()->addHours(24),
                [
                    'ResponseCacheControl' => 'max-age=31536000',
                ]);
        }

        $type = match (true) {
            str_contains($mime, 'image/') => 'イラスト',
            str_contains($mime, 'video/') => '動画',
            str_contains($mime, 'audio/') => '音声',
            str_contains($mime, '/zip') => 'ZIP',
            str_contains($model->file, '.vrm') => 'VRM',
            default => 'その他'
        };

        return 'https://placehold.jp/ffffff/333333/350x350.png?text='.urlencode($type);
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return mixed
     */
    public function set($model, string $key, $value, array $attributes)
    {
        throw new \LogicException();
    }
}
