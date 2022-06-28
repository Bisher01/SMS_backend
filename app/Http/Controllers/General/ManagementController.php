<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Claass;
use App\Models\Day;
use App\Models\Teacher;
use App\Traits\generalTrait;

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
}
