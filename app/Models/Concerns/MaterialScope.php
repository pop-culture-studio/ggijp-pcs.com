<?php

namespace App\Models\Concerns;

use Illuminate\Contracts\Database\Query\Builder;

trait MaterialScope
{
    /**
     * @param  Builder  $query
     * @param  string|null  $search
     * @return Builder
     */
    public function scopeKeywordSearch(Builder $query, ?string $search): Builder
    {
        return $query->when(filled($search), function (Builder $query, $b) use ($search) {
            return $query->where(function (Builder $query) use ($search) {
                $query->where('title', 'like', "%$search%")
                      ->orWhere('description', 'like', "%$search%")
                      ->orWhere('author', 'like', "%$search%")
                      ->orWhereHas('categories', function (Builder $query) use ($search) {
                          $query->where('name', 'like', "%$search%");
                      })
                      ->orWhereHas('user', function (Builder $query) use ($search) {
                          $query->where('name', 'like', "%$search%");
                      });
            });
        });
    }
}
