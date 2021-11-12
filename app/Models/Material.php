<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Material extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'file', 'title', 'description',
    ];

    protected $hidden = [
        'file',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function getThumbnailAttribute()
    {
        if (app()->runningUnitTests()) {
            return Storage::url($this->file);
        }

        $mime = Storage::mimeType($this->file);

        if (!str_contains($mime, 'image')) {
            $type = match (true) {
                str_contains($mime, 'image/') => 'イラスト',
                str_contains($mime, 'video/') => '動画',
                default => 'その他'
            };

            return 'https://placehold.jp/ffffff/333333/350x350.png?text=' . urlencode($type);
        }

        return Storage::temporaryUrl($this->file, now()->addMinutes(60));
    }
}
