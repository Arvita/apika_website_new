<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\CourseMaterial;
use App\Models\CourseMaterialSection;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $course = Course::firstOrCreate(
            ['slug' => 'pemrograman-dasar'],
            [
                'title' => 'Pemrograman Dasar',
                'title_en' => 'Basic Programming',
                'summary' => 'Konsep fundamental yang membentuk fondasi untuk membuat program komputer.',
                'category' => 'Programming',
                'is_featured' => true,
                'is_published' => true,
                'published_at' => now(),
            ]
        );

        $material = CourseMaterial::firstOrCreate(
            [
                'course_id' => $course->id,
                'slug' => 'file-handling',
            ],
            [
                'title' => 'File Handling',
                'week_label' => 'Minggu 12',
                'week_number' => 12,
                'summary' => 'Kemampuan PHP untuk membaca, menulis, dan memanipulasi file yang tersimpan di server.',
                'material_type' => 'lesson',
                'is_published' => true,
                'published_at' => now(),
                'sort_order' => 12,
            ]
        );

        CourseMaterialSection::firstOrCreate(
            [
                'course_material_id' => $material->id,
                'title' => 'Pengantar File Handling',
            ],
            [
                'type' => 'content',
                'body' => 'File Handling adalah kemampuan PHP untuk membaca, menulis, dan memanipulasi file yang tersimpan di server.',
                'sort_order' => 1,
                'is_published' => true,
            ]
        );

        CourseMaterialSection::firstOrCreate(
            [
                'course_material_id' => $material->id,
                'title' => 'Contoh Membuka File',
            ],
            [
                'type' => 'code',
                'body' => 'Contoh dasar membuka dan menutup file di PHP.',
                'code_language' => 'php',
                'code' => '$file = fopen(\"data.txt\", \"r\");' . PHP_EOL . 'if ($file) {' . PHP_EOL . '    fclose($file);' . PHP_EOL . '}',
                'sort_order' => 2,
                'is_published' => true,
            ]
        );
    }
}