<?php

namespace App\Models;

use App\Casts\Material\CategoryColor;
use App\Casts\Material\Image;
use App\Models\Concerns\MaterialFeed;
use App\Models\Concerns\MaterialScope;
use App\Support\IndexNow;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Feed\Feedable;

use function Illuminate\Events\queueable;

/**
 * @mixin IdeHelperMaterial
 */
class Material extends Model implements Feedable
{
    use HasFactory;
    use MaterialFeed;
    use MaterialScope;
    use SoftDeletes;

    protected $fillable = [
        'file',
        'title',
        'description',
        'author',
        'filesize',
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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'image' => Image::class,
            'categoryColor' => CategoryColor::class,
        ];
    }

    protected static function booted(): void
    {
        static::created(queueable(function (Material $material) {
            IndexNow::submit(route('material.show', $material));
        }));
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function mainCategory(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->categories?->first()
        );
    }
}
