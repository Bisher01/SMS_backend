<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ExamName;
use Illuminate\Support\Facades\DB;
class ExamNameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('exam_names')->delete();
        $names=['مذاكرة اولى ','مذاكرة ثانية','مذاكرة فصلية','امتحان'];
        foreach($names as $name){
           ExamName::create(['name'=>$name]);
        }
    }
}
