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
use App\Traits\generalTrait;
use Dflydev\DotAccessData\Data;
use Facade\FlareClient\Http\Exceptions\NotFound;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Builder\Class_;

class TimeTableController extends Controller
{
    use generalTrait;
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

        $info = $grade::query()->with('class', function ($query) {
            $query->with('classroom', function ($query) {
                $query->with('teacherSubjects', function ($query) {
                    $query->with('teachers');
                });
            });
        })->first();
        return $this->returnData('data', $info, 'success');

    }
}
