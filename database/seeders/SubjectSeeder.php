<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Subject;
class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      /*  DB::table('subjects')->delete();
        $subjects=['رياضيات','فيزياء','كيمياء','علوم','فرنسي','عربي','انجليزي','ديانة','رسم','رياضة','موسيقى','تاريخ','جغرافية','وطنية'];
        foreach($subjects as $subject){
            Subject::create(['name'=>$subject]);
        }*/
    }
}
