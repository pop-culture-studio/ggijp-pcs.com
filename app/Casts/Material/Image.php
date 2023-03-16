<?php

namespace App\Casts\Material;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use InvalidArgumentException;

/**
 * Material Image Cast.
 *
 * @template TGet
 * @template TSet
 */
class Image implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return TGet|null
     */
    public function get(Model $model, string $key, mixed $value, array $attributes)
    {
        return rescue(fn () => $this->url($model), config('pcs.not_found_image'));
    }

    private function url(Model $model): string
    {
        if (blank($model->file)) {
            throw new InvalidArgumentException();
        }

        if (app()->runningUnitTests()) {
            return Storage::url($model->file);
        }

        $mime = cache()->rememberForever('mimetype:'.$model->id, fn () => Storage::mimeType($model->file));

        if (filled($model->thumbnail) && Storage::exists($model->thumbnail)) {
            return Storage::temporaryUrl(
                $model->thumbnail,
                now()->addHours(24),
                [
                    'ResponseCacheControl' => 'max-age=31536000',
                ]);
        }

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
     * @param  Model  $model
     * @param  string  $key
     * @param  TSet|null  $value
     * @param  array  $attributes
     * @return mixed
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        throw new InvalidArgumentException();
    }
}
