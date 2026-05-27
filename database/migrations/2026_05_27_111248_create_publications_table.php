<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('publications', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->string('title_en')->nullable();
            $table->string('slug')->unique();

            $table->text('authors');
            $table->unsignedSmallInteger('year')->nullable();

            $table->string('venue')->nullable();
            $table->string('publisher')->nullable();
            $table->string('volume')->nullable();
            $table->string('issue')->nullable();
            $table->string('pages')->nullable();

            $table->string('type')->default('journal');
            $table->string('source')->default('manual');

            $table->string('doi')->nullable();
            $table->longText('abstract')->nullable();
            $table->longText('abstract_en')->nullable();
            $table->string('keywords')->nullable();
            $table->string('research_area')->nullable();

            $table->string('google_scholar_url', 2048)->nullable();
            $table->string('sinta_url', 2048)->nullable();
            $table->string('scopus_url', 2048)->nullable();
            $table->string('journal_url', 2048)->nullable();
            $table->string('pdf_url', 2048)->nullable();

            $table->unsignedInteger('citation_count')->default(0);

            $table->boolean('is_featured')->default(false);
            $table->boolean('is_published')->default(true);
            $table->timestamp('published_at')->nullable();
            $table->integer('sort_order')->default(0);

            $table->timestamps();

            $table->index(['is_published', 'year']);
            $table->index(['type', 'year']);
            $table->index('is_featured');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('publications');
    }
};