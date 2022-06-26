<?php

namespace Database\Seeders;

use App\Models\Academic_year;
use App\Models\Address;
use App\Models\Admin;
use App\Models\Blood;
use App\Models\Book;
use App\Models\Claass;
use App\Models\Classroom;
use App\Models\Gender;
use App\Models\Grade;
use App\Models\Mentor;
use App\Models\Paarent;
use App\Models\Religtion;
use App\Models\School_years;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//            DB::table('addresses')->delete();
            DB::table('classrooms')->delete();
            DB::table('claass_classrooms')->delete();
            DB::table('books')->delete();
            DB::table('academic_years')->delete();
//            DB::table('teachers')->delete();
//            DB::table('parents')->delete();
//            DB::table('subjects')->delete();
//            DB::table('students')->delete();
//            DB::table('mentors')->delete();

            //
//            Academic_year::query()->create([
//                'date' => '2022-05-03',
//            ]);
//
//            Address::query()->create([
//                'city' => 'test',
//                'street' => 'test',
//                'town' => 'test',
//            ]);

            Classroom::query()->create([
                'name' => 'test',
                'max_number' => 10,
            ]);
//
            DB::table('claass_classrooms')->insert([
                'class_id' => 1,
                'classroom_id' => 1,
            ]);
//
//            Paarent::query()->create([
//                'mother_name' => 'test',
//                'father_name' => 'test',
//                'national_number' => '0123456',
//                'code' => '00213007800',
//                'email' => 'abd@gmail.com',
//                'jop' => 'test',
//                'phone' => 'test',
//            ]);
//            Student::query()->create([
//                'f_name' => 'test',
//                'l_name' => 'test',
//                'email' => 'test@gmail.com',
//                'code' => '00113502800',
//                'nationality' => 'test',
//                'picture' => 'test',
//                'birthdate' => '2022-05-03',
//                'parent_id' => 1,
//                'blood_id' => 1,
//                'gender_id' => 1,
//                'religion_id' => 1,
//                'grade_id' => 1,
//                'class_id' => 1,
//                'classroom_id' => 1,
//                'academic_year_id' => 1,
//                'address_id' => 1,
//            ]);
//            Student::query()->create([
//                'f_name' => 'abd',
//                'l_name' => 'abd',
//                'email' => 'adb@gmail.com',
//                'code' => '00120002800',
//                'nationality' => 'test',
//                'picture' => 'test',
//                'birthdate' => '2022-05-03',
//                'parent_id' => 1,
//                'blood_id' => 1,
//                'gender_id' => 1,
//                'religion_id' => 1,
//                'grade_id' => 1,
//                'class_id' => 1,
//                'classroom_id' => 1,
//                'academic_year_id' => 1,
//                'address_id' => 1,
//            ]);
////
            Book::query()->create([
                'name' => 'test',
            ]);

//            Subject::query()->create([
//                'name' => 'test',
//            ]);
//
          /*  Teacher::query()->create([
                'subject_id' => 1,
                'address_id' => 1,
                'religion_id' => 1,
                'grade_id' => 1,
                'gender_id' => 1,
                'picture' => 'sssss',
                'f_name' => 'teacher',
                'l_name' => 'teacher',
                'email' => 'tea@gmail.com',
                'code' => '00315009800',
                'joining_date' => '2022-05-03',
                'salary' => '100',
            ]);
//
            Mentor::query()->create([
                'email' => 'mentor@gmail.com',
                'f_name' => 'mentor',
                'l_name' => 'mentor',
                'code' => '00412008500',
                'address_id' => 1,
                'joining_date' => '2022-05-03',
                'phone' => '0952200',
                'class_id' => 1,
            ]);*/

    }
}
