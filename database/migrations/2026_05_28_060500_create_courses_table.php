<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->string('title_en')->nullable();
            $table->string('slug')->unique();

            $table->text('summary')->nullable();
            $table->text('summary_en')->nullable();

            $table->longText('intro')->nullable();
            $table->longText('intro_en')->nullable();

            $table->longText('learning_objectives')->nullable();
            $table->longText('learning_objectives_en')->nullable();

            $table->string('cover_image')->nullable();
            $table->string('level')->nullable();
            $table->string('category')->nullable();

            $table->string('meta_title')->nullable();
            $table->string('meta_title_en')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_description_en')->nullable();

            $table->boolean('is_featured')->default(false);
            $table->boolean('is_published')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamp('published_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};