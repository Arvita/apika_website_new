<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class CourseMaterial extends Model
{
    protected $fillable = [
        'course_id',
        'title',
        'title_en',
        'slug',
        'week_label',
        'week_number',
        'summary',
        'summary_en',
        'content',
        'content_en',
        'material_type',
        'external_url',
        'file_path',
        'related_video_url',
        'meta_title',
        'meta_title_en',
        'meta_description',
        'meta_description_en',
        'is_published',
        'sort_order',
        'published_at',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function sections(): HasMany
    {
        return $this->hasMany(CourseMaterialSection::class)
            ->orderBy('sort_order')
            ->orderBy('id');
    }

    public function publishedSections(): HasMany
    {
        return $this->sections()->where('is_published', true);
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }

    public static function uniqueSlug(string $title, int $courseId, ?int $ignoreId = null): string
    {
        $base = Str::slug($title) ?: 'material';
        $slug = $base;
        $counter = 2;

        while (
            static::where('course_id', $courseId)
                ->where('slug', $slug)
                ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = "{$base}-{$counter}";
            $counter++;
        }

        return $slug;
    }
}