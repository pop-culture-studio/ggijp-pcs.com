<?php

namespace App\Models\Concerns;

use App\Models\Material;
use Illuminate\Database\Eloquent\Collection;
use Spatie\Feed\FeedItem;

trait MaterialFeed
{
    public function toFeedItem(): FeedItem
    {
        return FeedItem::create()
                       ->id(route('material.show', $this->id))
                       ->title($this->title)
                       ->summary($this->description ?? '')
                       ->image($this->image)
                       ->category(...$this->categories->pluck('name'))
                       ->updated($this->updated_at)
                       ->link(route('material.show', $this->id))
                       ->authorName(filled($this->author) ? $this->author : config('app.name'));
    }

    public static function getFeedItems(): Collection
    {
        return Material::latest('id')->take(10)->get();
    }
}
