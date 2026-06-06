<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Course extends Model
{
    protected $fillable = [
        'title',
        'title_en',
        'slug',
        'summary',
        'summary_en',
        'intro',
        'intro_en',
        'learning_objectives',
        'learning_objectives_en',
        'cover_image',
        'level',
        'category',
        'meta_title',
        'meta_title_en',
        'meta_description',
        'meta_description_en',
        'is_featured',
        'is_published',
        'sort_order',
        'published_at',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function materials(): HasMany
    {
        return $this->hasMany(CourseMaterial::class)
            ->orderBy('sort_order')
            ->orderBy('week_number');
    }

    public function publishedMaterials(): HasMany
    {
        return $this->materials()->where('is_published', true);
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }

    public static function uniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $base = Str::slug($title) ?: 'course';
        $slug = $base;
        $counter = 2;

        while (
            static::where('slug', $slug)
                ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = "{$base}-{$counter}";
            $counter++;
        }

        return $slug;
    }
}