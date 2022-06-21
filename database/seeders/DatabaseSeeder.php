<?php

namespace Database\Seeders;

use App\Models\Classroom;
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
         $this->call(AdminSeeder::class);

        $this->call([
            BloodSeeder::class,
            TestSeeder::class,
//            AdminSeeder::class,

//            ClassroomSeeder::class,
//            GenderSeeder::class,
//            GradeSeeder::class,
//            ReligtionSeeder::class,
//            SubjectSeeder::class,
//            SectionSeeder::class
        ]);
    }
}
