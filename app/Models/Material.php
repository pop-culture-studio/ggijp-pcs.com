<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use function Illuminate\Events\queueable;

class Material extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'file', 'title', 'description',
    ];

    protected $hidden = [
        'file', 'thumbnail',
    ];

    protected static function booted()
    {
        static::saved(queueable(function ($material) {
            cache()->delete('side.cats');
        }));

        static::deleted(queueable(function ($material) {
            cache()->delete('side.cats');
        }));
    }

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
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
                return Storage::temporaryUrl($this->thumbnail, now()->addMinutes(60));
            }

            $mime = cache()->rememberForever('mimetype:'.$this->id, fn () => Storage::mimeType($this->file));

            if (str_contains($mime, 'image/')) {
                return Storage::temporaryUrl($this->file, now()->addMinutes(60));
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
            return 'https://placehold.jp/ffffff/999999/350x350.png?text='.urlencode('Not Found');
        }
    }

    /**
     * @param  Builder  $query
     * @param  string|null  $search
     * @return Builder
     */
    public function scopeKeywordSearch(Builder $query, ?string $search): Builder
    {
        return $query->when($search, function (Builder $query, $search) {
            return $query->where(function (Builder $query) use ($search) {
                $query->where('title', 'LIKE', "%$search%")
                      ->orWhere('description', 'LIKE', "%$search%")
                      ->orWhereHas('categories', function (Builder $query) use ($search) {
                          $query->where('name', 'like', "%$search%");
                      })->orWhereHas('user', function (Builder $query) use ($search) {
                        $query->where('name', 'like', "%$search%");
                    });
            });
        });
    }
}
