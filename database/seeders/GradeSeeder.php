<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Grade;
class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('grades')->delete();
        $grades=['المرحلة الابتدائية','المرحلة الاعدادية','المرحلة الثانوية'];
        foreach($grades as $grade){
            Grade::create(['name' => $grade]);
        }
    }
}
