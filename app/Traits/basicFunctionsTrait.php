<?php
namespace App\Traits;

use App\Models\Address;
use App\Models\Blood;
use App\Models\ClassClassroom;
use Illuminate\Support\Facades\DB;


trait basicFunctionsTrait{
    use generalTrait;
    public function addAddress($request) {

         $address  = Address::query()
            ->where('city', $request->city)
            ->where('street', $request->street)
            ->where('town', $request->town)
            ->first();
        if (!isset($address)) {
            $address = Address::query()->create([
                'city' => $request->city,
                'street' => $request->street,
                'town' => $request->town,
            ]);
            return $address;
        }
        return $address;


    }
    public function getBloods() {
        $bloods = Blood::query()->get();
        return $bloods;
    }

    public function checkClassClassroom($claassId, $classroomId) {
        $classClassroom = ClassClassroom::query()
            ->select('id')
            ->where('class_id', $claassId)
            ->where('classroom_id', $classroomId)
            ->first();
        return $classClassroom;
    }


//    error
    public function checkTeacherSubject($teacherId, $subjectId, $classId, $classroomId) {
        $test = $this->checkClassClassroom($classId, $classroomId);
        if (isset($test))
        dd(true);
        $teachSubject = DB::table('teacher__subjects')
            ->select('id')
            ->where('subject_id', $subjectId)
            ->where('teacher_id', $teacherId)
            ->first();
        return $teachSubject;
    }

    public function quizInfo($quiz) {
        $quizInfo = DB::table('quizzes')
            ->select(['quiz_name_id', 'teacher_subject_id'])
            ->where('id', $quiz->id)->first();

        $teacSub = DB::table('teacher__subjects')
            ->where('id', $quizInfo->teacher_subject_id)->first();

        $classClassroom = ClassClassroom::query()->where('id', $teacSub->class_classroom_id)->first();
        $class = DB::table('claasses')
            ->select(['id', 'name', 'grade_id'])
            ->where('id', $classClassroom->class_id)->first();

        $classroom = DB::table('classrooms')->select('name')
            ->where('id', $classClassroom->classroom_id)->first();

//        $teacherSubjcet = DB::table('teacher__subjects')
//            ->where('id', $C_Cr_T_S_id->t_s_id)->first();

        $teacher = DB::table('teachers')
            ->select(['id', 'f_name', 'l_name', 'picture'])
            ->where('id', $teacSub->teacher_id)->first();

        $subject = DB::table('subjects')
            ->select(['id', 'name'])
            ->where('id', $teacSub->subject_id)->first();

        $data['quiz'] = $quiz;
        $data['subject'] = $subject;
        $data['class'] = $class;
        $data['classroom'] = $classroom;
        $data['teacher'] = $teacher;

        return $data;
    }
}
