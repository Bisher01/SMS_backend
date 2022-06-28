<?php

namespace Database\Seeders;

use App\Models\Lesson;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lessons')->delete();

        Lesson::query()->create([
           'name' => 'الحصة الاولى'
        ]);

        Lesson::query()->create([
           'name' => 'الحصة الثانية'
        ]);

        Lesson::query()->create([
           'name' => 'الحصة الثالثة'
        ]);

        Lesson::query()->create([
           'name' => 'الحصة الرابعة'
        ]);

        Lesson::query()->create([
           'name' => 'الحصة الخامسة'
        ]);

        Lesson::query()->create([
           'name' => 'الحصة السادسة'
        ]);

        Lesson::query()->create([
           'name' => 'الحصة السابعة'
        ]);


    }
}
