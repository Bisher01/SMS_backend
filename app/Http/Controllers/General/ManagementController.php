<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Models\ClassClassroom;
use Illuminate\Http\Request;
use App\Models\Claass;
use App\Models\Day;
use App\Models\Teacher;
use App\Traits\generalTrait;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;

class ManagementController extends Controller
{
    use generalTrait;
    public function addClassroomToClass(Request $request, Claass $claass) {
        $claass -> classroom()->syncWithoutDetaching($request -> classroom_Id);
        return $this->returnSuccessMessage('added classroom to class successfully');
    }

    public function addLessonsToDays(Request $request, Day $day) {
        $day -> lessons()->syncWithoutDetaching($request -> lesson_id);
        return $this->returnSuccessMessage('added lessons to day successfully');
    }

    public function addClassroomToTeacher(Request $request, Teacher $teacher) {
        $teacher -> classClassroom()->syncWithoutDetaching($request -> claass_classroom_id);
        return $this->returnSuccessMessage('added classroom to teacher successfully');
    }

    public function addSubjectToTeacher(Request $request, Teacher $teacher) {
        $teacher->subject()->syncWithoutDetaching($request->subject_id);
        return $this->returnSuccessMessage('added subject to teacher successfully');
    }
    public function customizeTeachForClassroom(Request $request) {
       $teacherId = $request->teacher_id;
       $subjectId = $request->subject_id;
       $claassId = $request->class_id;
       $classroomId = $request->classroom_id;

       $classClassroom = ClassClassroom::query()
           ->select('id')
           ->where('class_id', $claassId)
           ->where('classroom_id', $classroomId)
           ->first();
       if (!isset($classClassroom)) {
           return $this->returnErrorMessage('class or classroom not found', 404);
       }
       $teachSubject = DB::table('teacher__subjects')
           ->select('id')
           ->where('subject_id', $subjectId)
           ->where('teacher_id', $teacherId)
           ->first();
        if (!isset($teachSubject)) {
            return $this->returnErrorMessage('teacher or subject not found', 404);
        }
       $classClassroomId = $classClassroom->id;
       $teachSubjectId = $teachSubject->id;

       DB::table('claass_classroom_teacher_subject')->insert([
                't_s_id' => $teachSubjectId,
                'c_cr_id' => $classClassroomId
       ]);

       return $this->returnSuccessMessage('success');

    }
}