<?php

namespace App\Models;

use App\Casts\Material\CategoryColor;
use App\Casts\Material\Image;
use App\Models\Concerns\MaterialFeed;
use App\Models\Concerns\MaterialScope;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Feed\Feedable;

/**
 * @mixin IdeHelperMaterial
 */
class Material extends Model implements Feedable
{
    use HasFactory;
    use SoftDeletes;
    use MaterialScope;
    use MaterialFeed;

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
     * @var array
     */
    protected $casts = [
        'image' => Image::class,
        'categoryColor' => CategoryColor::class,
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
            get: fn ($value) => $this->categories?->first()
        );
    }
}
