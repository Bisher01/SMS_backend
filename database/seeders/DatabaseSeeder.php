<?php

namespace Database\Seeders;

use App\Models\Classroom;
use App\Models\Nationality;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       //  \App\Models\User::factory(10)->create();
       $this->call([
           BloodSeeder::class,
           GenderSeeder::class,
           ReligtionSeeder::class,
           GradeSeeder::class,
           ClaassSeeder::class,
           AdminSeeder::class,
           NationalitySeeder::class,
//         ClassroomSeeder::class,
           SubjectSeeder::class,
           TestSeeder::class,
//         SectionSeeder::class
        ]);

    }
}
