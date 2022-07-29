<?php

namespace Database\Seeders;

use App\Models\Claass;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClaassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Claasses')->delete();
        DB::table('classrooms')->delete();
        DB::table('classrooms')->insert([
            'name' => 1,
            'max_number' => 20
        ]);


            DB::table('Claasses')->insert([
                [
                    'name' => ' الصف الاول',
                    'grade_id' => '1'
                ],
                [
                    'name' => 'الصف الثاني',
                    'grade_id' => '1'
                ],
                [
                    'name' => 'الصف الثالث',
                    'grade_id' => '1'
                ], [
                    'name' => 'الصف الرابع',
                    'grade_id' => '1'
                ], [
                    'name' => 'الصف الخامس',
                    'grade_id' => '1'
                ], [
                    'name' => 'الصف السادس',
                    'grade_id' => '1'
                ],
                [
                    'name' => 'الصف السابع',
                    'grade_id' => '2'
                ], [
                    'name' => 'الصف الثامن',
                    'grade_id' => '2'
                ], [
                    'name' => 'الصف التاسع',
                    'grade_id' => '2'
                ],
                [
                    'name' => 'الصف الاول الثانوي ',
                    'grade_id' => '3'
                ], [
                    'name' => 'الصف الثاني الثانوي',
                    'grade_id' => '3'
                ], [
                    'name' => 'الصف الثالث الثانوي',
                    'grade_id' => '3'
                ],

            ]);

            for ($i =1 ; $i<= 12; $i++) {
                DB::table('claass_classrooms')->insert([
                    'class_id' => $i,
                    'classroom_id' => 1
                ]);
            }

    }
}
