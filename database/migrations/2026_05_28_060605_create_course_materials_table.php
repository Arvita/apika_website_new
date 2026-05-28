<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('course_materials', function (Blueprint $table) {
            $table->id();

            $table->foreignId('course_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('title');
            $table->string('title_en')->nullable();
            $table->string('slug');

            $table->string('week_label')->nullable();
            $table->unsignedInteger('week_number')->nullable();

            $table->text('summary')->nullable();
            $table->text('summary_en')->nullable();

            $table->longText('content')->nullable();
            $table->longText('content_en')->nullable();

            $table->string('material_type')->default('lesson');

            $table->string('external_url')->nullable();
            $table->string('file_path')->nullable();
            $table->string('related_video_url')->nullable();

            $table->string('meta_title')->nullable();
            $table->string('meta_title_en')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_description_en')->nullable();

            $table->boolean('is_published')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamp('published_at')->nullable();

            $table->timestamps();

            $table->unique(['course_id', 'slug']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('course_materials');
    }
};