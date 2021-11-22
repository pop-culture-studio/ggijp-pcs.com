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
        'file', 'title', 'description', 'thumbnail',
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

    public function getImageAttribute()
    {
        if (app()->runningUnitTests()) {
            return Storage::url($this->file);
        }

        if (Storage::missing($this->file)) {
            return 'https://placehold.jp/ffffff/999999/350x350.png?text='.
                urlencode('Not Found');
        }

        if (! empty($this->thumbnail) && Storage::exists($this->thumbnail)) {
            return Storage::temporaryUrl($this->thumbnail, now()->addMinutes(60));
        }

        $mime = Storage::mimeType($this->file);

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

        return 'https://placehold.jp/ffffff/333333/350x350.png?text='.
            urlencode($type)//.'&css=%7B%22background%22%3A%22%20-webkit-gradient(linear%2C%20left%20top%2C%20left%20bottom%2C%20from(%236366F1)%2C%20to(%23ffffff))%22%7D'
            ;
    }
}
