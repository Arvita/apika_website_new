<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CourseMaterialSection extends Model
{
    protected $fillable = [
        'course_material_id',
        'title',
        'title_en',
        'type',
        'body',
        'body_en',
        'code',
        'code_language',
        'media_url',
        'button_label',
        'button_url',
        'sort_order',
        'is_published',
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    public function material(): BelongsTo
    {
        return $this->belongsTo(CourseMaterial::class, 'course_material_id');
    }
}