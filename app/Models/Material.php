<?php

namespace App\Models;

use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;

/**
 * @mixin IdeHelperMaterial
 */
class Material extends Model implements Feedable
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'file',
        'title',
        'description',
        'author',
    ];

    protected $hidden = [
        'file', 'thumbnail',
    ];

    /**
     * The number of models to return for pagination.
     *
     * @var int
     */
    protected $perPage = 50;

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['categories'];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsToMany
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * @return Attribute
     */
    public function mainCategory(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $this->categories?->first()
        );
    }

    /**
     * @return string
     */
    public function getImageAttribute()
    {
        try {
            if (app()->runningUnitTests()) {
                return Storage::url($this->file);
            }

            if (filled($this->thumbnail) && Storage::exists($this->thumbnail)) {
                return Storage::temporaryUrl(
                    $this->thumbnail,
                    now()->addHours(24),
                    [
                        'ResponseCacheControl' => 'max-age=31536000',
                    ]);
            }

            $mime = cache()->rememberForever('mimetype:'.$this->id, fn () => Storage::mimeType($this->file));

            if (str_contains($mime, 'image/')) {
                return Storage::temporaryUrl(
                    $this->file,
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
                str_contains($this->file, '.vrm') => 'VRM',
                default => 'その他'
            };

            return 'https://placehold.jp/ffffff/333333/350x350.png?text='.urlencode($type);
        } catch (\Exception) {
            return config('pcs.not_found_image');
        }
    }

    /**
     * @return string
     */
    public function getCategoryColorAttribute(): string
    {
        $cat = $this->categories?->first();

        $color = Arr::first(config('pcs.category'), fn ($value) => Arr::get($value, 'title') === $cat?->name);

        return Arr::get($color, 'color', 'indigo-500');
    }

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

    public static function getFeedItems()
    {
        return Material::latest('id')->take(10)->get();
    }
}
