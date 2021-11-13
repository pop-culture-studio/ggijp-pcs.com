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
                str_contains($mime, 'audio/') => '音声',
                str_contains($mime, '/zip') => 'ZIP',
                default => 'その他'
            };

            return 'https://placehold.jp/ffffff/6366F1/350x350.png?text=' .
                urlencode($type)
                //.'&css=%7B%22background%22%3A%22%20-webkit-gradient(linear%2C%20left%20top%2C%20left%20bottom%2C%20from(%236366F1)%2C%20to(%23ffffff))%22%7D'
            ;
        }

        return Storage::temporaryUrl($this->file, now()->addMinutes(60));
    }
}
