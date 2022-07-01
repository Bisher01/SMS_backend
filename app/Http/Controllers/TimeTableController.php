<?php

namespace App\Http\Controllers;

use App\Models\Claass;
use App\Models\ClassClassroom;
use App\Models\Classroom;
use App\Models\Day;
use App\Models\Grade;
use App\Models\Lesson;
use App\Models\Teacher;
use App\Models\TimeTable;
use Dflydev\DotAccessData\Data;
use Facade\FlareClient\Http\Exceptions\NotFound;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Builder\Class_;

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


    public function show(Request $request,Grade $grade,Day $day,Lesson $lesson)
    {

        $classs=DB::table('claasses')
        ->where('grade_id',$grade->id)
        ->select('id','name')
        ->get();

        foreach($classs as $class){

            $class_room[]=DB::table('claass_classrooms')
            ->where('class_id', $class->id)
            ->select('id')
            ->get();

        }

         foreach( $class_room as  $one_class_room){

           $class_room_teacher[]=DB::table('claass_classroom_teacher_subject')
           ->select('t_s_id')
           ->where('c_cr_id',$one_class_room)
           ->get();

        }

        return $class_room_teacher;



        //  $class=Claass::query()->where('grade_id',$grade->id)->select('id','name')
        //  ->with('classroom',function($query){
        //        $query->select('name');})->get();


        //  return $class;

    }
}
