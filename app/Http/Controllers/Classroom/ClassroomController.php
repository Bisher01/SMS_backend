<?php

namespace App\Http\Controllers\Classroom;

use App\Http\Controllers\Controller;
use App\Models\Claass;
use App\Models\ClassClassroom;
use App\Models\Classroom;
use App\Models\Quiz;
use App\Models\TeacherSubject;
use App\Traits\basicFunctionsTrait;
use App\Traits\generalTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClassroomController extends Controller
{
    use generalTrait,  basicFunctionsTrait;

    public function index()
    {
        $classrooms = Classroom::query()->get();
        return $this->returnAllData('classroomms', $classrooms, 'all classroom');

//        return $this->returnData('classroomms', $classrooms, 'all classroom');
    }


    public function store(Request $request)
    {
        foreach($request->classroom as $classroom){

            $newclassroom = Classroom::query()->create([
                'name' => $classroom['name'],
                'max_number' =>  $classroom['max_number'],
            ]);

            $newclassroom -> class()->syncWithoutDetaching($classroom['class_id']);

        }

        return  $this->returnData('classroom', $newclassroom, 'added classroom & choose the classes which belongto successfully');

    }

    public function update(Request $request, Classroom $classroom)
    {
        $classroom->update([
            'name' => $request->name,
            'max_number' => $request->max_number,
        ]);
        return  $this->returnData('classroom', $classroom, 'updated classroom successfully');

    }

    public function destroy(Classroom $classroom)
    {
        $classroom->delete();
        return $this->returnSuccessMessage('deleted classroom successfully');
    }

    public function quizScheduleForClassroom(Claass $claass, Classroom $classroom)
    {
        $checkClassClassroom = $this->checkClassClassroom($claass->id, $classroom->id);
        if (!isset($checkClassClassroom)) {
            return $this->returnErrorMessage('input error', 400);
        }
        $classClassroomId = ClassClassroom::query()
            ->select('id')
            ->where('class_id', $claass->id)
            ->where('classroom_id', $classroom->id)
            ->first();

        $teacherSubjects = TeacherSubject::query()
            ->where('class_classroom_id', $classClassroomId->id)
            ->get();

        foreach ($teacherSubjects as $teacherSubject) {
            $quizzes = DB::table('quizzes')
                ->where('teacher_subject_id', $teacherSubject->id)
                ->get();
            foreach ($quizzes as $quiz) {
                $q[] = $quiz;
            }
        }
        return $q;

    }
}
