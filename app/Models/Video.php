<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Video extends Model
{
    protected $fillable = [
        'title',
        'title_en',
        'slug',
        'youtube_url',
        'youtube_id',
        'description',
        'description_en',
        'category',
        'topic',
        'year',
        'is_featured',
        'is_published',
        'published_at',
        'sort_order',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }

    public function getEmbedUrlAttribute(): string
    {
        return 'https://www.youtube.com/embed/' . $this->youtube_id;
    }

    public function getThumbnailUrlAttribute(): string
    {
        return 'https://img.youtube.com/vi/' . $this->youtube_id . '/hqdefault.jpg';
    }

    public static function extractYoutubeId(string $url): ?string
    {
        $patterns = [
            '/youtu\.be\/([a-zA-Z0-9_-]{11})/',
            '/youtube\.com\/watch\?v=([a-zA-Z0-9_-]{11})/',
            '/youtube\.com\/embed\/([a-zA-Z0-9_-]{11})/',
            '/youtube\.com\/shorts\/([a-zA-Z0-9_-]{11})/',
        ];

        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $url, $matches)) {
                return $matches[1];
            }
        }

        return null;
    }

    public static function uniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $base = Str::slug($title);
        $slug = $base;
        $counter = 2;

        while (
            static::where('slug', $slug)
            ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
            ->exists()
        ) {
            $slug = "{$base}-{$counter}";
            $counter++;
        }

        return $slug;
    }
}
