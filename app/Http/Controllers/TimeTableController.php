<?php

namespace App\Http\Controllers;

use App\Models\Claass;
use App\Models\ClassClassroom;
use App\Models\Classroom;
use App\Models\Day;
use App\Models\Grade;
use App\Models\Lesson;
use App\Models\TimeTable;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class TimeTableController extends Controller
{
    public function store(Request $request)
    {
        $timetaple=TimeTable::query()->create([

            'check' => $request->check,
            'grade_id' =>$request->grade_id,
            'lesson_day_id'=>$request->lesson_day_id,
            'teacher_info_id'=>$request->teacher_info_id

        ]);
        return $timetaple;
    }


    public function show(Request $request,Grade $grade,Day $day)
    {


     //  $timetaple=TimeTable::query()->get();
    //    $grade_name=Grade::select('name')->where($request->grade_id,$grade->id);
 // $c=DB::table('lesson_day')->where('day_id',$request->day_id)->get();
   // $a = Grade::query()->where('id',$request->grade_id)->get('name');
   // $d=$c->pluck('lesson_id');
    // $day=Day::query()->where('id',$request->day_id)->get('name');


     $a = $day->lessons()->pluck('name');
     $b = $grade->class()->pluck('name');


     $c = $grade->class()->pluck('id');
    foreach($c as $cc){

      $ali=Claass::find($cc);

      $al[]=$ali->classroom()->get();
       // $d[]= ClassClassroom::query()->where('class_id',$cc)->pluck('classroom_id');
     }
     foreach($al as $all)
     {

        $all=Classroom::find($all);
        $aa[]=$all->teachers()->get();
     }

//     $classroom=Classroom::query()->where('id',$d)->get('name');
       return $al;




     // return [[$grade->name,$b],[$day->name,$a]];


    }
}
