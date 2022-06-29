<?php

namespace Database\Seeders;

use App\Models\QuestionType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('question_types')->delete();
        $names=['اتمتة','صح وخطأ','تقليدي'];
        foreach($names as $name){
           QuestionType::create(['name'=>$name]);
        }
    }
}
