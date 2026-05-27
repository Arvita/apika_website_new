<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    protected $fillable = [
        'title',
        'title_en',
        'slug',
        'authors',
        'year',
        'venue',
        'publisher',
        'volume',
        'issue',
        'pages',
        'type',
        'source',
        'doi',
        'abstract',
        'abstract_en',
        'keywords',
        'research_area',
        'google_scholar_url',
        'sinta_url',
        'scopus_url',
        'journal_url',
        'pdf_url',
        'citation_count',
        'is_featured',
        'is_published',
        'published_at',
        'sort_order',
    ];

    protected $casts = [
        'year' => 'integer',
        'citation_count' => 'integer',
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    public function displayTitle(string $locale = 'id'): string
    {
        return $locale === 'en' && $this->title_en
            ? $this->title_en
            : $this->title;
    }

    public function displayAbstract(string $locale = 'id'): ?string
    {
        return $locale === 'en' && $this->abstract_en
            ? $this->abstract_en
            : $this->abstract;
    }
}