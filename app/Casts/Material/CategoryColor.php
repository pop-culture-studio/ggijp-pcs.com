<?php

namespace App\Casts\Material;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use InvalidArgumentException;

/**
 * Material CategoryColor Cast.
 *
 * @template TGet
 * @template TSet
 */
class CategoryColor implements CastsAttributes
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
        $cat = $model->categories?->first();

        $color = Arr::first(config('pcs.category'), fn ($value) => Arr::get($value, 'title') === $cat?->name);

        return Arr::get($color, 'color', 'indigo-500');
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
