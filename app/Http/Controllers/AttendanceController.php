<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\ClassClassroom;
use App\Models\Mentor;
use App\Models\Student;
use App\Traits\basicFunctionsTrait;
use App\Traits\generalTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    use basicFunctionsTrait, generalTrait;

    public function store(Request $request) {
        foreach ($request->students as $student) {
            $check  = DB::table('attendances')
                ->where('student_id', $student['student_id'])
                ->where('date', $request->date)->first();
            if (isset($check)) {
                DB::table('attendances')->where('id', $check->id)->update([
                    'status_id' => $student['status_id']
                ]);
            }
            if (!isset($check)) {
                DB::table('attendances')->insert([
                    'student_id' => $student['student_id'],
                    'status_id' => $student['status_id'],
                    'date' => $request->date
                ]);
            }

        }
        return $this->returnSuccessMessage('success');
    }

    public function getAttendance(Request $request) {
        $check = Attendance::query()->where('date', $request->date)->first();
        if (!isset($check)) {
            return $this->returnSuccessMessage('Excuse Me!!!!');
        }
        $classClassroomId = $this->checkClassClassroom($request->class_id, $request->classroom_id);
        if (isset($classClassroomId)){
            $students = Student::query()
                ->where('class_classroom_id', $classClassroomId->id)
                ->with('attendance', function ($query) use ($request) {
                    $query->where('date', $request->date);
                })
                ->get();
            return $this->returnAllData('data', $students, 'success');
        }
    }
    public function getAttendanceStudent(Student $student) {
        return $this->returnData('data',$student->load('attendance'), 'success');
    }
}
