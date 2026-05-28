<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('course_material_sections', function (Blueprint $table) {
            $table->id();

            $table->foreignId('course_material_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('title');
            $table->string('title_en')->nullable();

            $table->string('type')->default('content');

            $table->longText('body')->nullable();
            $table->longText('body_en')->nullable();

            $table->longText('code')->nullable();
            $table->string('code_language')->nullable();

            $table->string('media_url')->nullable();
            $table->string('button_label')->nullable();
            $table->string('button_url')->nullable();

            $table->integer('sort_order')->default(0);
            $table->boolean('is_published')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('course_material_sections');
    }
};