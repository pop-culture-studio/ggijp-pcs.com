<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @mixin IdeHelperCategory
 */
class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function getRouteKeyName(): string
    {
        return 'name';
    }

    public function materials(): BelongsToMany
    {
        return $this->belongsToMany(Material::class);
    }
}
